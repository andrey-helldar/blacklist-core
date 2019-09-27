<?php

namespace Helldar\BlacklistCore\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Helldar\BlacklistCore\Constants\Server;
use Helldar\BlacklistCore\Facades\Validator;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Psr\Http\Message\ResponseInterface;

use function compact;
use function trim;

class HttpClientService
{
    private $base_uri;

    private $client;

    private $headers = Server::HEADERS;

    private $timeout = 0;

    private $uri_suffix;

    private $verify = true;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function setTimeout(int $value = 0)
    {
        Validator::validate(compact('value'), [
            'value' => ['required', 'integer', 'min:0', 'max:60'],
        ]);

        $this->timeout = $value;

        return $this;
    }

    public function setBaseUri(string $value)
    {
        Validator::validate(compact('value'), [
            'value' => ['required', 'string', 'active_url'],
        ]);

        $this->base_uri = $value;

        return $this;
    }

    public function setUriSuffix(string $value = null)
    {
        $this->uri_suffix = trim($value);

        return $this;
    }

    public function setVerify(bool $value = true)
    {
        $this->verify = $value;

        return $this;
    }

    public function setHeaders(array $values)
    {
        $this->headers = $values;

        return $this;
    }

    public function addHeader(string $key, string $value)
    {
        $this->headers = Arr::add($this->headers, $key, $value);

        return $this;
    }

    /**
     * @param string $method
     * @param array $data
     *
     * @return ResponseInterface
     * @throws GuzzleException
     *
     */
    public function send(string $method, array $data): ResponseInterface
    {
        $uri = rtrim(Server::URI, '/');

        if ($this->uri_suffix) {
            $uri .= Str::start($this->uri_suffix, '/');
        }

        return $this->client
            ->request($method, $uri, [
                'base_uri'    => $this->base_uri,
                'verify'      => $this->verify,
                'timeout'     => $this->timeout,
                'headers'     => $this->headers,
                'form_params' => $data,
            ]);
    }
}

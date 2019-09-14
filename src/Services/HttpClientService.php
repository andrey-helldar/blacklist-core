<?php

namespace Helldar\BlacklistCore\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Helldar\BlacklistCore\Constants\Server;
use Helldar\BlacklistCore\Facades\Validator;
use Illuminate\Support\Arr;
use Psr\Http\Message\ResponseInterface;

class HttpClientService
{
    private $client;

    private $base_uri;

    private $verify = true;

    private $timeout = 0;

    private $headers = Server::HEADERS;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    public function setTimeout(int $value = 0)
    {
        Validator::validate(\compact('value'), [
            'value' => ['required', 'integer', 'min:0', 'max:60'],
        ]);

        $this->timeout = $value;

        return $this;
    }

    public function setBaseUri(string $value)
    {
        Validator::validate(\compact('value'), [
            'value' => ['required', 'string', 'active_url'],
        ]);

        $this->base_uri = $value;

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
     * @throws GuzzleException
     *
     * @return ResponseInterface
     */
    public function send(string $method, array $data): ResponseInterface
    {
        return $this->client
            ->request($method, Server::URI, [
                'base_uri'    => $this->base_uri,
                'verify'      => $this->verify,
                'timeout'     => $this->timeout,
                'headers'     => $this->headers,
                'form_params' => $data,
            ]);
    }
}

<?php

namespace Helldar\BlacklistCore\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use Helldar\BlacklistCore\Constants\Server;
use Helldar\BlacklistCore\Exceptions\IncorrectValueException;
use Helldar\BlacklistCore\Helpers\Arr;
use Helldar\BlacklistCore\Helpers\Str;
use Psr\Http\Message\ResponseInterface;

use function http_build_query;
use function trim;

class HttpClientService
{
    private $base_uri;

    private $client;

    private $headers = Server::HEADERS;

    private $timeout = 0;

    private $uri_suffix;

    private $verify = false;

    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * @param int $value
     *
     * @throws IncorrectValueException
     * @return $this
     */
    public function setTimeout(int $value = 0)
    {
        $min = 0;
        $max = 60;

        if ($value < $min || $value > $max) {
            throw new IncorrectValueException(__FILE__, __LINE__, "The setTimeout must be between {$min} and {$max}. {$value} given.");
        }

        $this->timeout = $value;

        return $this;
    }

    /**
     * @param string $value
     *
     * @throws IncorrectValueException
     * @return $this
     */
    public function setBaseUri(string $value)
    {
        if (! filter_var($value, FILTER_VALIDATE_URL)) {
            throw new IncorrectValueException(__FILE__, __LINE__, "The setBaseUri must be a valid URL. {$value} given.");
        }

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
     * @throws GuzzleException
     *
     * @return ResponseInterface
     */
    public function send(string $method, array $data): ResponseInterface
    {
        $url = $this->getUrl($method, $data);

        return $this->client
            ->request($method, $url, [
                'base_uri'    => $this->base_uri,
                'verify'      => $this->verify,
                'timeout'     => $this->timeout,
                'headers'     => $this->headers,
                'form_params' => $data,
            ]);
    }

    private function validate(array $data, array $rules)
    {
        Validator::make($data, $rules)->validate();
    }

    private function getUrl(string $method, array $data): string
    {
        $uri = rtrim(Server::URI, '/');

        if ($this->uri_suffix) {
            $uri .= Str::start($this->uri_suffix, '/');
        }

        if (Str::upper($method) === 'GET') {
            $uri .= '?' . http_build_query($data);
        }

        return $uri;
    }
}

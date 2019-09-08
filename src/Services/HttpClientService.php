<?php

namespace Helldar\BlacklistCore\Services;

use GuzzleHttp\Client;
use Helldar\BlacklistCore\Constants\Server;
use Helldar\BlacklistCore\Facades\Validator;
use Illuminate\Support\Arr;

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

    public function setBaseUri(string $url)
    {
        Validator::validate(\compact('url'), [
            'value' => ['required', 'active_url'],
        ]);

        $this->base_uri = $url;

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
     * @throws \GuzzleHttp\Exception\GuzzleException
     *
     * @return string
     */
    public function send(string $method, array $data)
    {
        return $this->client
            ->request($method, [
                'base_uri'    => $this->base_uri,
                'verify'      => $this->verify,
                'timeout'     => $this->timeout,
                'headers'     => $this->headers,
                'form_params' => $data,
            ])
            ->getBody()
            ->getContents();
    }
}

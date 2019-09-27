<?php

namespace Helldar\BlacklistCore\Facades;

use Helldar\BlacklistCore\Services\HttpClientService;
use Illuminate\Support\Facades\Facade;
use Psr\Http\Message\ResponseInterface;

class HttpClient extends Facade
{
    /**
     * @method static HttpClientService setTimeout($value)
     * @method static HttpClientService setBaseUri($url)
     * @method static HttpClientService setVerify($value)
     * @method static HttpClientService setHeaders($url)
     * @method static HttpClientService addHeader($url)
     * @method static ResponseInterface send($url)
     *
     * @return HttpClientService|string
     */
    protected static function getFacadeAccessor()
    {
        return HttpClientService::class;
    }
}

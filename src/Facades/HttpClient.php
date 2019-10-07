<?php

namespace Helldar\BlacklistCore\Facades;

use Helldar\BlacklistCore\Services\HttpClientService;
use Psr\Http\Message\ResponseInterface;

/**
 * @method static HttpClientService setTimeout($value)
 * @method static HttpClientService setBaseUri($url)
 * @method static HttpClientService setVerify($value)
 * @method static HttpClientService setHeaders($url)
 * @method static HttpClientService addHeader($url)
 * @method static ResponseInterface send($url)
 */
class HttpClient extends Facade
{
    protected static function getFacadeAccessor()
    {
        return HttpClientService::class;
    }
}

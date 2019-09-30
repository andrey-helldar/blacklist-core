<?php

namespace Helldar\BlacklistCore\Constants;

class Server
{
    const BASE_URL = 'https://blacklist.ai-rus.com';

    const HEADERS = ['Accept' => 'application/json'];

    const ROUTE_MIDDLEWARE = 'api';

    const ROUTE_PREFIX = 'api.blacklist.';

    const URI = 'api/blacklist';

    public static function selfValues(): array
    {
        return [
            '127.0.0.1',
            self::host(),
            self::configHost(),
            self::email(),
        ];
    }

    public static function host(): string
    {
        return request()->getHost();
    }

    public static function configHost(): string
    {
        return parse_url(config('app.url'), PHP_URL_HOST);
    }

    public static function email(): string
    {
        return config('mail.from.address');
    }
}

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
            self::url(),
            self::configUrl(),
            self::email(),
        ];
    }

    public static function url(): string
    {
        return request()->url();
    }

    public static function configUrl(): string
    {
        return config('app.url');
    }

    public static function email(): string
    {
        return config('mail.from.address');
    }
}

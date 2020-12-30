<?php

namespace Helldar\BlacklistCore\Constants;

class Server
{
    public const HEADERS          = ['Accept' => 'application/json'];

    public const ROUTE_MIDDLEWARE = 'api';

    public const ROUTE_PREFIX     = 'api.blacklist.';

    public const URI              = 'api/blacklist';

    public static function selfValues(): array
    {
        return [
            '*127.0.0.1*',
            '*localhost*',
            sprintf('*%s*', self::host()),
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

    public static function host(): string
    {
        return request()->getHost();
    }

    public static function email(): string
    {
        return config('mail.from.address');
    }
}

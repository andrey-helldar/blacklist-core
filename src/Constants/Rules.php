<?php

namespace Helldar\BlacklistCore\Constants;

use Helldar\BlacklistCore\Exceptions\UnknownTypeException;
use Helldar\BlacklistCore\Helpers\Arr;
use Helldar\BlacklistCore\Helpers\Str;

class Rules
{
    public const AVAILABLE = [
        'email' => ['required', 'string', 'email', 'min:7', 'max:255'],
        'url'   => ['required', 'string', 'url', 'min:5', 'max:255'],
        'phone' => ['required', 'string', 'min:4', 'max:255'],
        'ip'    => ['required', 'string', 'ip'],
    ];

    public const MESSAGES = [
        'value.url' => 'The :attribute is not a valid URL.',
    ];

    public const default = ['required', 'string', 'min:4', 'max:255'];

    /**
     * @param string|null $type
     * @param bool $is_require_type
     *
     * @throws \Helldar\BlacklistCore\Exceptions\UnknownTypeException
     *
     * @return array
     */
    public static function get(string $type = null, bool $is_require_type = true): array
    {
        if (null === $type && $is_require_type) {
            throw new UnknownTypeException($type);
        }

        if (! $is_require_type) {
            return static::default;
        } elseif ($result = Arr::get(self::AVAILABLE, $type)) {
            return $result;
        }

        foreach (Types::get() as $key) {
            if (Str::lower($key) === Str::lower($type)) {
                return self::get($type);
            }
        }

        return static::default;
    }
}

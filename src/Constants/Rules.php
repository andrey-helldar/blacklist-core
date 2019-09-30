<?php

namespace Helldar\BlacklistCore\Constants;

use Helldar\BlacklistCore\Exceptions\UnknownTypeException;
use Helldar\BlacklistCore\Rules\ExceptBlocking;
use Helldar\BlacklistCore\Rules\SelfBlocking;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class Rules
{
    const AVAILABLE = [
        'email' => ['required', 'string', 'email', 'min:7', 'max:255'],
        'url'   => ['required', 'string', 'url', 'min:5', 'max:255'],
        'phone' => ['required', 'string', 'min:4', 'max:255'],
        'ip'    => ['required', 'string', 'ip'],
    ];

    const DEFAULT = ['required', 'string', 'min:4', 'max:255'];

    const MESSAGES = [
        'value.url' => 'The :attribute is not a valid URL.',
    ];

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
            return self::attachCheckBlocking();
        } elseif ($result = Arr::get(self::AVAILABLE, $type)) {
            return self::attachCheckBlocking($result);
        }
        foreach (Types::get() as $key) {
            if (Str::lower($key) === Str::lower($type)) {
                return self::attachCheckBlocking(self::get($type));
            }
        }

        return self::attachCheckBlocking();
    }

    private static function attachCheckBlocking(array $rules = null): array
    {
        $rules = $rules ?: self::DEFAULT;

        return array_values(
            array_merge($rules, [
                new SelfBlocking(),
                new ExceptBlocking(),
            ])
        );
    }
}

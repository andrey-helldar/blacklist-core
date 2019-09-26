<?php

namespace Helldar\BlacklistCore\Constants;

use Helldar\BlacklistCore\Exceptions\UnknownTypeException;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

use function is_null;

class Rules
{
    const AVAILABLE = [
        'email' => ['required', 'string', 'email', 'max:255'],
        'host'  => ['required', 'string', 'url', 'max:255'],
        'phone' => ['required', 'string', 'max:255'],
        'ip'    => ['required', 'ip'],
    ];

    const DEFAULT   = ['required', 'string', 'max:255'];

    const MESSAGES  = [
        'value.url' => 'The :attribute is not a valid URL.',
    ];

    /**
     * @param string|null $type
     * @param bool $is_require_type
     *
     * @return array
     * @throws \Helldar\BlacklistCore\Exceptions\UnknownTypeException
     */
    public static function get(string $type = null, bool $is_require_type = true): array
    {
        if (is_null($type) && $is_require_type) {
            throw new UnknownTypeException($type);
        }

        if (! $is_require_type) {
            return self::DEFAULT;
        }
        elseif ($result = Arr::get(self::AVAILABLE, $type)) {
            return $result;
        }
        else {
            foreach (Types::get() as $key) {
                if (Str::lower($key) === Str::lower($type)) {
                    return self::get($type);
                }
            }
        }

        return self::DEFAULT;
    }
}

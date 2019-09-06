<?php

namespace Helldar\BlacklistCore\Constants;

use Helldar\BlacklistCore\Exceptions\UnknownTypeException;
use Illuminate\Support\Str;

class Types
{
    public static function get(): array
    {
        return \array_keys(Rules::AVAILABLE);
    }

    public static function getDivided(string $divider = ', ')
    {
        return
            \implode($divider,
                \array_map(
                    function ($item) {
                        return \sprintf('"%s"', Str::lower($item));
                    }, self::get()
                )
            );
    }

    /**
     * @param string|null $type
     *
     * @throws \Helldar\BlacklistCore\Exceptions\UnknownTypeException
     * @return bool
     */
    public static function check(string $type = null): bool
    {
        if (\in_array($type, self::get())) {
            return true;
        }

        throw new UnknownTypeException($type);
    }
}

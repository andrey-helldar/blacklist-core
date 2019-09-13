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

    public static function getDivided(string $divider = ', ', string $last_divider = ' or ')
    {
        $arr = \array_map(
            function ($item) {
                return Str::lower($item);
            }, self::get()
        );

        $last = \array_pop($arr);

        return \implode($divider, $arr) . $last_divider . $last;
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

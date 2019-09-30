<?php

namespace Helldar\BlacklistCore\Rules;

class ExceptBlocking
{
    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     *
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $server = config('blacklist_server.except', []);
        $client = config('blacklist_client.except', []);

        $except = array_merge($server, $client);

        return ! in_array($value, $except);
    }

    public function message()
    {
        return 'An attempt was made to block an excluded resource!';
    }
}
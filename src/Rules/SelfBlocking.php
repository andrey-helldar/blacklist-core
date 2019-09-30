<?php

namespace Helldar\BlacklistCore\Rules;

use Helldar\BlacklistCore\Constants\Server;

class SelfBlocking
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
        return ! in_array($value, Server::selfValues());
    }

    public function message()
    {
        return 'You are trying to block yourself!';
    }
}
<?php

namespace Helldar\BlacklistCore\Rules;

use Helldar\BlacklistCore\Constants\Server;
use Illuminate\Contracts\Validation\Rule;

class SelfBlocking implements Rule
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

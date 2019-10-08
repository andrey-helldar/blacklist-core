<?php

namespace Helldar\BlacklistCore\Exceptions;

use Exception;

class SelfBlockingException extends Exception
{
    public function __construct()
    {
        parent::__construct('You are trying to block yourself!', 422);
    }
}
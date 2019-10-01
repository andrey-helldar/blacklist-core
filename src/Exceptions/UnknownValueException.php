<?php

namespace Helldar\BlacklistCore\Exceptions;

use Exception;

class UnknownValueException extends Exception
{
    public function __construct()
    {
        $message = 'The value field is required.';

        parent::__construct($message, 400);
    }
}

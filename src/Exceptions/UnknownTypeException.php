<?php

namespace Helldar\BlacklistCore\Exceptions;

use Exception;
use Helldar\BlacklistCore\Constants\Types;

class UnknownTypeException extends Exception
{
    public function __construct($type)
    {
        $message = sprintf('The type must be one of %s, "%s" given.', Types::getDivided(' or '), $type);

        parent::__construct($message, 400);
    }
}

<?php

namespace Helldar\BlacklistCore\Exceptions;

use Exception;
use Helldar\BlacklistCore\Constants\Types;
use function sprintf;

class UnknownServerTypeException extends Exception
{
    public function __construct($type)
    {
        $message = sprintf('The server must be one of the types: %s, "%s" given.', Types::getDivided(' or '), $type);

        parent::__construct($message, 400);
    }
}

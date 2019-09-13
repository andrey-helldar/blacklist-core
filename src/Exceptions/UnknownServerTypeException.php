<?php

namespace Helldar\BlacklistCore\Exceptions;

use Exception;
use Helldar\BlacklistCore\Constants\Types;
use function sprintf;

class UnknownServerTypeException extends Exception
{
    public function __construct(string $type = null)
    {
        $type    = empty($type) ? 'null' : $type;
        $message = sprintf('The server must be one of the types: %s, %s given.', Types::getDivided(), $type);

        parent::__construct($message, 400);
    }
}

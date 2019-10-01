<?php

namespace Helldar\BlacklistCore\Exceptions;

use Exception;

use function sprintf;

class IncorrectValueException extends Exception
{
    public function __construct(string $file, int $line, string $message)
    {
        $msg = sprintf('%s (%s:%s)', $message, $file, $line);

        parent::__construct($msg, 400);
    }
}
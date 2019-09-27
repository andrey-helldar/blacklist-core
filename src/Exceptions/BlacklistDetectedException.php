<?php

namespace Helldar\BlacklistCore\Exceptions;

use Exception;
use Illuminate\Support\Str;

use function sprintf;

class BlacklistDetectedException extends Exception
{
    public function __construct(string $value = null)
    {
        $message = sprintf('Checked %s was found in our database.', Str::lower($value));

        parent::__construct($message, 423);
    }
}

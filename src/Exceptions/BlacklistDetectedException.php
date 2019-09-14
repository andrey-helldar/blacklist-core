<?php

namespace Helldar\BlacklistCore\Exceptions;

use Exception;
use Illuminate\Support\Str;
use function sprintf;

class BlacklistDetectedException extends Exception
{
    public function __construct(string $type = null, string $value = null)
    {
        $type    = empty($type) ? 'null' : $type;
        $message = sprintf('Checked %s %s was found in our database.', Str::lower($type), Str::lower($value));

        parent::__construct($message, 423);
    }
}

<?php

namespace Helldar\BlacklistCore\Exceptions;

use Exception;

class ExcludedBlockingDetectedException extends Exception
{
    public function __construct()
    {
        $message = 'An attempt was made to block an excluded resource!';

        parent::__construct($message, 422);
    }
}

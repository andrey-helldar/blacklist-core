<?php

namespace Helldar\BlacklistCore\Exceptions;

use Exception;

class SelfBlockingDetected extends Exception
{
    public function __construct(string $value = null)
    {
        parent::__construct("You are trying to block yourself! ($value)", 500);
    }
}

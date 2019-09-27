<?php

namespace Helldar\BlacklistCore\Exceptions;

use Exception;

class ExceptBlockingDetected extends Exception
{
    public function __construct(string $value = null)
    {
        parent::__construct("An attempt was made to block an excluded resource! ($value)", 500);
    }
}

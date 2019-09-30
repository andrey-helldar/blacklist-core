<?php

namespace Helldar\BlacklistCore\Facades;

use Helldar\BlacklistCore\Services\CheckBlockingService;
use Illuminate\Support\Facades\Facade;

/**
 * @method static void selfBlocking(string $value)
 * @method static void exceptBlocking(string $value)
 */
class CheckBlocking extends Facade
{
    protected static function getFacadeAccessor()
    {
        return CheckBlockingService::class;
    }
}
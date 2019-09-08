<?php

namespace Helldar\BlacklistCore\Facades;

use Helldar\BlacklistCore\Services\ValidationService;
use Illuminate\Support\Facades\Facade;

class Validator extends Facade
{
    /**
     * @method static ValidationService make(array $data, array $rules, array $messages = [], array $customAttributes = [])
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return ValidationService::class;
    }
}

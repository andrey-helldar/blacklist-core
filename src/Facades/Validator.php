<?php

namespace Helldar\BlacklistCore\Facades;

use Helldar\BlacklistCore\Services\ValidationService;
use Illuminate\Contracts\Validation\Validator as ValidatorContract;
use Illuminate\Validation\ValidationException;

/**
 * @method static ValidationService validate(array $data, bool $is_require_type = true)
 * @method static ValidatorContract make(array $data, bool $is_require_type = true)
 * @method static array flatten(ValidationException $exception)
 *
 * @return string
 */
class Validator extends Facade
{
    protected static function getFacadeAccessor()
    {
        return ValidationService::class;
    }
}

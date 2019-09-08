<?php

namespace Helldar\BlacklistCore\Services;

use Illuminate\Support\Facades\Validator;

class ValidationService
{
    public function validate(array $data, array $rules, array $messages = [], array $customAttributes = [])
    {
        Validator::make($data, $rules, $messages, $customAttributes)
            ->validate();
    }
}

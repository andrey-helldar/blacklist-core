<?php

namespace Helldar\BlacklistCore\Services;

use Helldar\BlacklistCore\Constants\Rules;
use Helldar\BlacklistCore\Constants\Types;
use Illuminate\Contracts\Validation\Validator as ValidatorContract;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ValidationService
{
    public function validate(array $data, bool $is_require_type = true)
    {
        $this->make($data, $is_require_type)
            ->validate();
    }

    public function make(array $data, bool $is_require_type = true): ValidatorContract
    {
        $type = Arr::get($data, 'type');

        return Validator::make($data, [
            'type'  => [
                $is_require_type ? 'required' : 'nullable',
                'string',
                Rule::in(Types::get()),
            ],
            'value' => Arr::get(Rules::get($type), $type, Rules::DEFAULT),
        ], Rules::MESSAGES);
    }
}

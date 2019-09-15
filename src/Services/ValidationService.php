<?php

namespace Helldar\BlacklistCore\Services;

use function compact;
use Helldar\BlacklistCore\Constants\Rules;
use Helldar\BlacklistCore\Constants\Types;
use Illuminate\Contracts\Validation\Validator as ValidatorContract;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Validator;

use Illuminate\Validation\Rule;

class ValidationService
{
    public function validate(string $type = null, string $value = null, bool $is_require_type = true)
    {
        $this->make($type, $value, $is_require_type)
            ->validate();
    }

    public function make(string $type = null, string $value = null, bool $is_require_type = true): ValidatorContract
    {
        return Validator::make(compact('type', 'value'), [
            'type'  => [
                $is_require_type ? 'required' : 'nullable',
                'string',
                Rule::in(Types::get()),
            ],
            'value' => Arr::get(Rules::get($type), $type, Rules::DEFAULT),
        ], Rules::MESSAGES);
    }
}

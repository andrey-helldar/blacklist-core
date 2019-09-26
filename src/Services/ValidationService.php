<?php

namespace Helldar\BlacklistCore\Services;

use Helldar\BlacklistCore\Constants\Rules;
use Helldar\BlacklistCore\Constants\Types;
use Illuminate\Contracts\Validation\Validator as ValidatorContract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ValidationService
{
    /**
     * @param \Illuminate\Http\Request $request
     * @param bool $is_require_type
     *
     * @throws \Helldar\BlacklistCore\Exceptions\UnknownTypeException
     */
    public function validate(Request $request, bool $is_require_type = true)
    {
        $this->make($request, $is_require_type)
            ->validate();
    }

    /**
     * @param \Illuminate\Http\Request $request
     * @param bool $is_require_type
     *
     * @return \Illuminate\Contracts\Validation\Validator
     * @throws \Helldar\BlacklistCore\Exceptions\UnknownTypeException
     */
    public function make(Request $request, bool $is_require_type = true): ValidatorContract
    {
        $type = $request->get('type');

        return Validator::make($request->all(), [
            'type'  => $this->getTypeRules($is_require_type),
            'value' => $this->getValueRules($type, $is_require_type),
        ], Rules::MESSAGES);
    }

    private function getTypeRules(bool $is_require_type = true): array
    {
        return [
            $is_require_type ? 'required' : 'nullable',
            'string',
            Rule::in(Types::get()),
        ];
    }

    /**
     * @param string|null $type
     * @param bool $is_require_type
     *
     * @return array
     * @throws \Helldar\BlacklistCore\Exceptions\UnknownTypeException
     */
    private function getValueRules(string $type = null, bool $is_require_type = true): array
    {
        return Rules::get($type, $is_require_type);
    }
}

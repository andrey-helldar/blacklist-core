<?php

namespace Helldar\BlacklistCore\Contracts;

use Helldar\BlacklistServer\Models\Blacklist;
use Illuminate\Http\Request;

interface ServiceContract
{
    public function store(Request $request): Blacklist;

    public function check(Request $request): void;

    public function exists(string $value): bool;
}

<?php

namespace Helldar\BlacklistCore\Contracts;

interface ServiceContract
{
    public function store(string $type, string $value);

    public function check(string $value = null): string;

    public function exists(string $value): bool;
}
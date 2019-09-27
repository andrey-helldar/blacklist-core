<?php

namespace Helldar\BlacklistCore\Contracts;

interface ClientServiceContract
{
    public function store(string $value, string $type);

    public function check(string $value);

    public function exists(string $value): bool;
}

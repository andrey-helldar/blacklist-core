<?php

namespace Helldar\BlacklistCore\Contracts;

interface ClientServiceContract
{
    public function store(string $value, string $type);

    public function check(string $value, string $type = null);

    public function exists(string $value, string $type = null): bool;
}

<?php

namespace Helldar\BlacklistCore\Contracts;

interface ServiceContract
{
    public function store(string $value = null, string $type = null);

    public function check(string $value = null, string $type = null);

    public function exists(string $value = null, string $type = null): bool;
}

<?php

namespace Helldar\BlacklistCore\Contracts;

interface ServiceContract
{
    public function store(array $data);

    public function check(array $data);

    public function exists(string $value): bool;
}

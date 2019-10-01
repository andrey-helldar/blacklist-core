<?php

use Helldar\BlacklistClient\Helpers\Env;
use Illuminate\Support\Env as IlluminateEnv;

if (! function_exists('value')) {
    /**
     * Return the default value of the given value.
     *
     * @param mixed $value
     *
     * @return mixed
     */
    function value($value)
    {
        return $value instanceof Closure ? $value() : $value;
    }
}

if (! function_exists('env')) {
    /**
     * Gets the value of an environment variable.
     *
     * @param string $key
     * @param mixed $default
     *
     * @return mixed
     */
    function env($key, $default = null)
    {
        if (class_exists(IlluminateEnv::class)) {
            return IlluminateEnv::get($key, $default);
        }

        return Env::get($key, $default);
    }
}
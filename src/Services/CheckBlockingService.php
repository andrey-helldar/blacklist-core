<?php

namespace Helldar\BlacklistCore\Services;

use Helldar\BlacklistCore\Constants\Server;
use Helldar\BlacklistCore\Exceptions\ExceptBlockingDetected;
use Helldar\BlacklistCore\Exceptions\SelfBlockingDetected;

class CheckBlockingService
{
    /**
     * @param string $value
     *
     * @throws SelfBlockingDetected
     */
    public function selfBlocking(string $value): void
    {
        if (in_array($value, Server::selfValues())) {
            throw new SelfBlockingDetected($value);
        }
    }

    /**
     * @param string $value
     *
     * @throws ExceptBlockingDetected
     */
    public function exceptBlocking(string $value): void
    {
        $server = config('blacklist_server.except', []);
        $client = config('blacklist_client.except', []);

        $except = array_merge($server, $client);

        if (in_array($value, $except)) {
            throw new ExceptBlockingDetected($value);
        }
    }
}

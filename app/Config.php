<?php

declare(strict_types=1);

namespace App;

/**
 * @property-read ?array $db
 */

class Config
{
    protected array $config = [];

    public function __construct(array $env)
    {
        $this->config = [
            'db' => [
                'driver'   => $env['DB_DRIVER'] ?? 'mysql',
                'host'     => $env['DB_HOST'],
                'database' => $env['DB_DATABASE'],
                'user'     => $env['DB_USER'],
                'pass'     => $env['DB_PASS']
            ], // add other configuration
        ];
    }

    // to make the keys of the config array get called like they are properties of Config class
    public function __get(string $name)
    {
        return $this->config[$name] ?? null;
    }
}
<?php

declare(strict_types=1);

namespace App;

use PDO;

class DB extends PDO
{
    public function __construct(array $config)
    {
        $defaultOptions = [
            PDO::ATTR_EMULATE_PREPARES => false,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ];

        parent::__construct(
            $config['driver'] . ':host=' . $config['host'] . ';dbname=' . $config['database'], 
            $config['user'], 
            $config['pass'],
            $config['options'] ?? $defaultOptions
        );
    }
}
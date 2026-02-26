<?php

declare(strict_types=1);

require __DIR__ . "/../vendor/autoload.php";
require_once __DIR__ . "/../app/Helpers/helpers.php";

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

session_start();

define('VIEWS_PATH', __DIR__ . '/../views/');
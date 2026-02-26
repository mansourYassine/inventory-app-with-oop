<?php

declare(strict_types=1);

use App\Controllers\HomeController;
use App\Exceptions\RouteNotFoundException;
use App\View;
use App\Router;

require __DIR__ . "/../vendor/autoload.php";
require_once __DIR__ . "/../app/Helpers/helpers.php";

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

session_start();

define('VIEWS_PATH', __DIR__ . '/../views/');

$router = new Router();

$router->get('/', [HomeController::class, "index"]);

try {
    echo $router->resolve($_SERVER["REQUEST_URI"], strtolower($_SERVER["REQUEST_METHOD"]));
} catch (RouteNotFoundException) {
    header('HTTP/1.1 404 Not Found');
    // http_response_code(404);
    echo View::make('errors/404');
}

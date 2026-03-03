<?php

declare(strict_types=1);

use App\App;
use App\Config;
use App\Controllers\CategoryController;
use App\Controllers\HomeController;
use App\Controllers\ProductController;
use App\Controllers\StockMovementController;
use App\Controllers\SupplierController;
use App\Router;

require __DIR__ . "/../vendor/autoload.php";
require_once __DIR__ . "/../app/Helpers/helpers.php";

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

session_start();

define('VIEWS_PATH', __DIR__ . '/../views/');

$router = new Router();

$router->get('/', [HomeController::class, 'index'])
    ->get('/products', [ProductController::class, 'index'])
    ->get('/products/add', [ProductController::class, 'add'])
    ->post('/products/add', [ProductController::class, 'store'])
    ->post('/products/info', [ProductController::class, 'showInfo'])
    ->get('/categories', [CategoryController::class, 'index'])
    ->get('/suppliers', [SupplierController::class, 'index'])
    ->get('/stock-movements', [StockMovementController::class, 'index']);

(new App(
    $router, 
    ['uri' => $_SERVER["REQUEST_URI"], 'method' => $_SERVER["REQUEST_METHOD"]],
    new Config($_ENV)
))->run();

<?php

declare(strict_types=1);

namespace App;

use App\Exceptions\RouteNotFoundException;

class Router 
{
    private array $routes;

    public function register(string $requestMethod, string $route, callable | array $action) : self
    {
        $this->routes[$requestMethod][$route] = $action;
        return $this;
    }

    public function get(string $route, callable | array $action) : self
    {
        return $this->register('get', $route, $action);
    }

    public function post(string $route, callable | array $action) : self
    {
        return $this->register('post', $route, $action);
    }

    public function resolve(string $requestUri, string $requestMethod)
    {
        $pathUri = parse_url($requestUri)["path"];
        $action = $this->routes[$requestMethod][$pathUri] ?? null;

        if ($action == null) {
            throw new RouteNotFoundException();
        }

        if (is_callable($action)) {
            return call_user_func($action);
        }

        if (is_array($action)) {
            [$class, $method] = $action;
            if (class_exists($class)) {
                $classObject = new $class();
                if (method_exists($classObject, $method)) {
                    return call_user_func_array([$classObject, $method], []);
                }
            }
        }

        throw new RouteNotFoundException();
    }
}
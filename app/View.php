<?php

declare(strict_types=1);

namespace App;

use App\Exceptions\FileNotFoundException;

class View
{
    public function __construct(
        protected string $view,
        protected array $params = []
    ){}

    // Create object of the view class
    public static function make(string $view, array $params = []) : static
    {
        return new static($view, $params);
    }

    // Return the html content of the view as a string
    public function render() : string
    {
        $viewPath = VIEWS_PATH . $this->view . '.php';

        if(!file_exists($viewPath)) {
            throw new FileNotFoundException();
        }

        // Make the params's keys as variables to use directly in the views
        // method 1:
        // foreach ($this->params as $key => $value) {
        //     $$key = $value;
        // }
        // method 2:
        extract($this->params);

        ob_start();
        include $viewPath;
        return (string) ob_get_clean();
    }

    // Make the objects of this class to be rendered as string
    // It invoked When the user try to echo an object of this class
    public function __toString()
    {
        return $this->render();
    }

    // for accessing the values of the params[] as properties of the object in the views
    // public function __get($name)
    // {
    //     return $this->params[$name] ?? null;
    // }
}
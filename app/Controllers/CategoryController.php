<?php

declare(strict_types=1);

namespace App\Controllers;

use App\View;

class CategoryController
{
    public function index(): View
    {
        return View::make('categories/index');
    }
}
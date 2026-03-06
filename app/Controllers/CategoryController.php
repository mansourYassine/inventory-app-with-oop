<?php

declare(strict_types=1);

namespace App\Controllers;

use App\View;

class CategoryController extends BaseController
{
    public function index(): View
    {
        $allCategories = $this->category->getAll();
        return View::make('categories/index', ['categories' => $allCategories]);
    }

    public function add(): View {

    }

    public function store() {

    }

    public function showInfo(): View {

    }

    public function remove() {

    }

    public function edit(): View {

    }
    
    public function update() {

    }

}
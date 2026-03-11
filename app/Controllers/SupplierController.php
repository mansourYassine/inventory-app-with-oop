<?php

declare(strict_types=1);

namespace App\Controllers;

use App\View;

class SupplierController extends BaseController
{
    public function index(): View
    {
        return View::make('suppliers/index');
    }

    public function add(): View {
        return View::make('');
    }

    public function store() {

    }

    public function showInfo(): View {
        return View::make('');
    }

    public function remove() {

    }

    public function edit(): View {
        return View::make('');
    }

    public function update() {

    }
}
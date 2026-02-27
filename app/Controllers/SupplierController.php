<?php

declare(strict_types=1);

namespace App\Controllers;

use App\View;

class SupplierController
{
    public function index(): View
    {
        return View::make('suppliers/index');
    }
}
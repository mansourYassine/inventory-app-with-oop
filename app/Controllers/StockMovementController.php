<?php

declare(strict_types=1);

namespace App\Controllers;

use App\View;

class StockMovementController
{
    public function index(): View
    {
        return View::make('stock-movements/index');
    }
}
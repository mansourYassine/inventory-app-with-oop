<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\StockMovement;
use App\View;

class StockMovementController extends BaseController
{
    private StockMovement $stockMovement;
    private array $stockMovements;
    private array $products;
    public function __construct()
    {
        $this->stockMovement = new StockMovement();
        $this->stockMovements = $this->stockMovement->getAll();
        parent::__construct();
        $this->products = $this->product->getAll();
    }

    public function index(): View
    {
        return View::make('stock-movements/index', ['stockMovements' => $this->stockMovements]);
    }

    public function add(): View 
    {
        return View::make('stock-movements/index');
    }
    public function store() 
    {

    }
    public function showInfo(): View 
    {
        return View::make('stock-movements/index');
    }
    public function remove() 
    {

    }
    public function edit(): View 
    {
        return View::make('stock-movements/index');
    }
    public function update() 
    {

    }
}
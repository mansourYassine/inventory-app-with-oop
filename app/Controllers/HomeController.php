<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Product;
use App\View;

class HomeController
{
    protected Product $product;
    public function __construct()
    {
        $this->product = new Product();
    }

    public function index(): View
    {
        $totalProductsNumber = $this->product->getTotalNumber();
        $totalProductsQuantity = $this->product->getTotalQuantity();
        $totalProductsValue = $this->product->getTotalValue();
        $lowStockProducts = $this->product->getLowStock();
        
        return View::make('index', [
            'totalProductsNumber' => $totalProductsNumber,
            'totalProductsQuantity' => $totalProductsQuantity,
            'totalProductsValue' => $totalProductsValue,
            'lowStockProducts' => $lowStockProducts,
        ]);
    }
}
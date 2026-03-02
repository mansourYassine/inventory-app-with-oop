<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Product;
use App\View;

class ProductController
{
    public function index(): View
    {
        $product = new Product();
        $allProducts = $product->getAllProducts();
        return View::make('products/index', ['allProducts' => $allProducts]);
    }
}
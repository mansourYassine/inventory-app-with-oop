<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use App\View;

abstract class BaseController
{
    protected Product $product;
    protected Supplier $supplier;
    protected Category $category;
    public function __construct()
    {
        $this->product = new Product();
        $this->supplier = new Supplier();
        $this->category = new Category();
    }

    abstract public function index(): View;
    abstract public function add(): View;
    abstract public function store();
    abstract public function showInfo(): View;
    abstract public function remove();
    abstract public function edit(): View;
    abstract public function update();

}
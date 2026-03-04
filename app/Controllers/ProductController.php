<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use App\View;

class ProductController
{
    private Product $product;
    private Supplier $supplier;
    private Category $category;
    public function __construct()
    {
        $this->product = new Product();
        $this->supplier = new Supplier();
        $this->category = new Category();
    }

    public function index(): View
    {
        $allProducts = $this->product->getAll();
        return View::make('products/index', ['allProducts' => $allProducts]);
    }

    public function add(): View
    {
        $allSuppliers = $this->supplier->getAllSuppliers();
        $allCategories = $this->category->getAllCategories();
        return View::make('products/add', ['allSuppliers' => $allSuppliers, 'allCategories' => $allCategories]);
    }

    public function store()
    {
        // Check if product name doesn't exist
        $allProducts = $this->product->getAll();
        $productsName = array_map(function ($product) {
            return $product['product_name'];
        }, $allProducts);
        $productName = "";
        for ($i=0; $i < count($productsName); $i++) { 
            if (strcmp(strtolower($_POST['product_name']),strtolower($productsName[$i]))) {
                $productName = $_POST['product_name'];
            } else {
                echo ('<h1>Product name already existed</h1>');
                die;
            }
        }

        $categoryId = intval($_POST['category_id']);
        $supplierId = intval($_POST['supplier_id']);
        $productQuantity = intval($_POST['product_quantity']);
        $productPrice = floatval($_POST['product_price']);

        $this->product->create($productName, $categoryId, $supplierId, $productQuantity, $productPrice);

        header('Location: /products');
        exit();
    }

    public function showInfo(): View
    {
        $productId = intval($_POST['product_id']);
        $productInfo = $this->product->find($productId);

        return View::make('products/info', ['productInfo' => $productInfo]);
    }
}
<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\Supplier;
use App\View;

class ProductController
{
    public function index(): View
    {
        $product = new Product();
        $allProducts = $product->getAllProducts();
        return View::make('products/index', ['allProducts' => $allProducts]);
    }

    public function add(): View
    {
        $supplier = new Supplier();
        $allSuppliers = $supplier->getAllSuppliers();
        $category = new Category();
        $allCategories = $category->getAllCategories();
        return View::make('products/add', ['allSuppliers' => $allSuppliers, 'allCategories' => $allCategories]);
    }

    public function store()
    {
        $product = new Product();
        
        // Check if product name doesn't exist
        $allProducts = $product->getAllProducts();
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

        $product->create($productName, $categoryId, $supplierId, $productQuantity, $productPrice);

        header('Location: /products');
        exit();
    }
}
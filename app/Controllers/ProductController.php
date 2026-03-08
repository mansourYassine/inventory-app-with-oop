<?php

declare(strict_types=1);

namespace App\Controllers;

use App\View;

class ProductController extends BaseController
{
    public function index(): View
    {
        $allProducts = $this->product->getAll();
        $jsonProducts = json_encode($this->product->getAll());

        $allSuppliers = $this->supplier->getAll();
        $allCategories = $this->category->getAll();
        return View::make('products/index', ['allProducts' => $allProducts, 'allSuppliers' => $allSuppliers, 'allCategories' => $allCategories, 'jsonProducts' => $jsonProducts]);
    }

    public function add(): View
    {
        $allSuppliers = $this->supplier->getAll();
        $allCategories = $this->category->getAll();
        return View::make('products/add', ['allSuppliers' => $allSuppliers, 'allCategories' => $allCategories]);
    }

    public function store()
    {
        // Check if product name doesn't exist
        $products = $this->product->getAll();
        $productsNames = array_map(function ($product) {
            return $product['product_name'];
        }, $products);

        $isProductExist = false;
        foreach ($productsNames as $productName) {
            if (strcmp(strtolower($_POST['product_name']),strtolower($productName)) === 0) {
                $isProductExist = true;
            }
        }

        $productName = "";
        if ($isProductExist === false) {
            $productName = $_POST['product_name'];
        } else {
            echo ('<h1>Product name already existed</h1>');
            die;
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

    public function remove()
    {
        $productIdToDelete = intval($_POST['delete_product_id']);
        $this->product->delete($productIdToDelete);
        header('Location: /products');
        exit();
    }

    public function edit(): View
    {
        $productIdToEdit = intval($_POST['edit_product_id']);
        $productInfo = $this->product->find($productIdToEdit);
        $allCategories = $this->category->getAll();
        $allSuppliers = $this->supplier->getAll();
        return View::make('products/edit', [
            'productInfo' => $productInfo, 
            'allCategories' => $allCategories, 
            'allSuppliers' => $allSuppliers
        ]);
    }

    public function update()
    {
        $productId = intval($_POST['product_id']);
        $productName = $_POST['product_name'];
        $categoryId = intval($_POST['category_id']);
        $supplierId = intval($_POST['supplier_id']);
        $productQuantity = intval($_POST['product_quantity']);
        $productPrice = floatval($_POST['product_price']);
        $this->product->edit($productId, $productName, $categoryId, $supplierId, $productQuantity, $productPrice);
        header('Location: /products');
        exit();
    }
}

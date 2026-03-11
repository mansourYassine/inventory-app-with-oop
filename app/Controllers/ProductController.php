<?php

declare(strict_types=1);

namespace App\Controllers;

use App\View;

class ProductController extends BaseController
{
    private array $products;
    private array $categories;
    private array $suppliers;
    public function __construct()
    {
        parent::__construct();
        $this->products = $this->product->getAll();
        $this->categories = $this->category->getAll();
        $this->suppliers = $this->supplier->getAll();
    }

    public function index(): View
    {
        $jsonProducts = json_encode($this->products);
        return View::make('products/index', 
            ['allProducts' => $this->products, 
            'allSuppliers' => $this->suppliers, 
            'allCategories' => $this->categories, 
            'jsonProducts' => $jsonProducts]);
    }

    public function add(): View
    {
        return View::make('products/add', ['allSuppliers' => $this->suppliers, 'allCategories' => $this->categories]);
    }

    public function store()
    {
        // Check if product name doesn't exist
        $productsNames = array_map(function ($product) {
            return $product['product_name'];
        }, $this->products);

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
        return View::make('products/edit', [
            'productInfo' => $productInfo, 
            'allCategories' => $this->categories, 
            'allSuppliers' => $this->suppliers
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

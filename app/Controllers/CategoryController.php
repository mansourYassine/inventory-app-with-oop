<?php

declare(strict_types=1);

namespace App\Controllers;

use App\View;

class CategoryController extends BaseController
{
    private array $categories;
    public function __construct()
    {
        parent::__construct();
        $this->categories = $this->category->getAll();
    }

    public function index(): View
    {
        return View::make('categories/index', ['categories' => $this->categories]);
    }

    public function add(): View {
        return View::make('categories/add');
    }

    public function store() {
        // Check if category name doesn't already exist
        $categoriesNames = array_map(function ($category) {
            return $category['category_name'];
        }, $this->categories);
        
        $isCategoryExist = false;
        foreach ($categoriesNames as $categoryName) {
            if (strcmp(strtolower($_POST['category_name']),strtolower($categoryName)) === 0) {
                $isCategoryExist = true;
            }
        }

        $categoryName = "";
        if ($isCategoryExist === false) {
            $categoryName = $_POST['category_name'];
        } else {
            echo ('<h1>category name already existed</h1>');
            die;
        }
        
        $this->category->create($categoryName);
        header('Location: /categories');
        exit();
    }

    public function showInfo(): View {
        $categoryId = intval($_POST['category_id']);
        $categoryInfo = $this->category->find($categoryId);
        return View::make('categories/info', ['categoryInfo' => $categoryInfo]);
    }

    public function remove() {
        $categoryId = intval($_POST['delete_category_id']);
        $this->category->delete($categoryId);
        header('Location: /categories');
        exit();
    }

    public function edit(): View {
        $categoryIdToEdit = intval($_POST['edit_category_id']);
        $categoryInfo = $this->category->find($categoryIdToEdit);
        return View::make('categories/edit', ['categoryInfo' => $categoryInfo]);
    }

    public function update() {
        $categoryId = intval($_POST['category_id']);
        $categoryName = $_POST['category_name'];
        $this->category->edit($categoryId, $categoryName);
        header('Location: /categories');
        exit();
    }
}
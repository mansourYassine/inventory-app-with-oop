<?php

declare(strict_types=1);

namespace App\Controllers;

use App\View;

class CategoryController extends BaseController
{
    public function index(): View
    {
        $allCategories = $this->category->getAll();
        return View::make('categories/index', ['categories' => $allCategories]);
    }

    public function add(): View {
        return View::make('categories/add');
    }

    public function store() {
        // Check if category name doesn't already exist
        $categories = $this->category->getAll();
        $categoriesNames = array_map(function ($category) {
            return $category['category_name'];
        }, $categories);
        
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

    }

    public function update() {

    }

}
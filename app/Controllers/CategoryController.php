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
        $categoriesName = array_map(function ($category) {
            return $category['category_name'];
        }, $categories);
        $categoryName = "";
        for ($i=0; $i < count($categoriesName); $i++) { 
            if (strcmp(strtolower($_POST['category_name']),strtolower($categoriesName[$i]))) {
                $categoryName = $_POST['category_name'];
            } else {
                echo ('<h1>category name already existed</h1>');
                die;
            }
        }
        
        $this->category->create($categoryName);
        header('Location: /categories');
        exit();
    }

    public function showInfo(): View {

    }

    public function remove() {

    }

    public function edit(): View {

    }

    public function update() {

    }

}
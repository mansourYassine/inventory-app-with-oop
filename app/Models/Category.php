<?php

declare(strict_types=1);

namespace App\Models;

use App\Model;

class Category extends Model
{
    public function getAll()
    {
        $query = "
            SELECT * FROM categories
            WHERE is_categ_active = 'YES'
        ";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $allCategories = $stmt->fetchAll();
        return $allCategories;
    }

    public function create(string $categoryName)
    {
        $query = "INSERT INTO categories (category_name)
                VALUES (?)";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$categoryName]);
    }
}
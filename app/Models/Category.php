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

    public function find(int $categoryId)
    {
        $query = "
            SELECT category_id, category_name
            FROM categories
            WHERE category_id = ?;
        ";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$categoryId]);
        $categoryInfo = $stmt->fetch();
        return $categoryInfo;
    }

    public function delete(int $categoryId)
    {
        $query = "
            UPDATE categories
            SET is_categ_active = 'NO'
            WHERE category_id = ?;
        ";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$categoryId]);
    }

    public function edit(int $categoryId, string $categoryName) 
    {
        $query = "
                UPDATE categories
                SET category_name = :category_name
                WHERE category_id = :category_id;
        ";
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            ':category_id' => $categoryId,
            ':category_name' => $categoryName       
        ]);
    }
}
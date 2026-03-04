<?php

declare(strict_types=1);

namespace App\Models;

use App\Model;

class Product extends Model
{
    public function getAll()
    {
        $query = '
        SELECT p.product_id, p.product_name, c.category_id, c.category_name, s.supplier_id, s.supplier_name, p.product_quantity, p.product_price, p.is_active
        FROM products p
        JOIN categories c
            ON p.category_id = c.category_id
        JOIN suppliers s
            ON p.supplier_id = s.supplier_id
        ';
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $products = $stmt->fetchAll();
        return $products;
    }

    public function create(string $productName, int $categoryId, int $supplierId, int $quantity, float $price)
    {
        $query = 'INSERT INTO products (product_name, category_id, supplier_id, product_quantity, product_price)
                VALUES (:product_name, :category_id, :supplier_id, :product_quantity, :product_price)';
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            'product_name' => $productName,
            'category_id' => $categoryId,
            'supplier_id' => $supplierId,
            'product_quantity' => $quantity,
            'product_price' => $price,
        ]);
    }

    public function find(int $productId)
    {
        $query = "
            SELECT p.product_id, p.product_name, c.category_name, c.category_id, s.supplier_name, s.supplier_id, p.product_quantity, p.product_price
            FROM products p
            JOIN categories c
                ON p.category_id = c.category_id
            JOIN suppliers s
                ON p.supplier_id = s.supplier_id
            WHERE p.product_id = ?;
        ";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$productId]);
        $productInfo = $stmt->fetch();
        return $productInfo;
    }
}

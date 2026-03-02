<?php

declare(strict_types=1);

namespace App\Models;

use App\Model;

class Product extends Model
{
    public function getAllProducts()
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
}
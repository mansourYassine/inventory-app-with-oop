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

    public function delete(int $productId)
    {
        $query = "
            UPDATE products
            SET is_active = 'NO'
            WHERE product_id = ?;
        ";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$productId]);
    }

    public function edit(
        int $productId,
        string $productName,
        int $categoryId,
        int $supplierId,
        int $productQuantity,
        float $productPrice
    ) {
        $query = "
            UPDATE products
            SET 
                product_name = :product_name, 
                category_id = :category_id, 
                supplier_id = :supplier_id, 
                product_quantity = :product_quantity, 
                product_price = :product_price
            WHERE product_id = :product_id;
        ";
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            'product_id'=> $productId,
            'product_name' => $productName,
            'category_id' => $categoryId,
            'supplier_id' => $supplierId,
            'product_quantity' => $productQuantity,
            'product_price' => $productPrice            
        ]);
    }

    public function getTotalNumber()
    {
        $query = "
            SELECT COUNT(*) AS total_products_number
            FROM products
            WHERE is_active = 'YES';
        ";
        $result = $this->db->query($query);
        $totalProductsNumber = $result->fetch()['total_products_number'];
        return $totalProductsNumber;
    }

    public function getTotalQuantity()
    {
        $query = "
            SELECT SUM(product_quantity) AS total_products_quantity
            FROM products
            WHERE is_active = 'YES';
        ";
        $result = $this->db->query($query);
        $totalProductsQuantity = $result->fetch()['total_products_quantity'];
        return $totalProductsQuantity;
    }

    public function getTotalValue()
    {
        $query = "
            SELECT SUM(product_quantity * product_price) AS total_products_value
            FROM products
            WHERE is_active = 'YES';
        ";
        $result = $this->db->query($query);
        $totalProductsValue = $result->fetch()['total_products_value'];
        return $totalProductsValue;
    }

    public function getLowStock()
    {
        $query = "
            SELECT *
            FROM products
            WHERE product_quantity <= 5;
        ";

        $result = $this->db->query($query);
        $lowStockProducts = $result->fetchAll();
        return $lowStockProducts;
    }
}

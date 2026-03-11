<?php

declare(strict_types=1);

namespace App\Models;

use App\Model;

class StockMovement extends Model
{
    public function getAll()
    {
        $query = '
            SELECT 
                s.stock_movement_id, 
                s.product_id, 
                p.product_name, 
                s.movement_quantity, 
                s.movement_type, 
                s.movement_date
            FROM stock_movements s
            JOIN products p
            ON s.product_id = p.product_id;
        ';
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $stockMovements = $stmt->fetchAll();
        return $stockMovements;
    }
}
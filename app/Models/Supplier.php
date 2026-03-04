<?php

declare(strict_types=1);

namespace App\Models;

use App\Model;

class Supplier extends Model
{
    public function getAll()
    {
        $query = "
            SELECT * FROM suppliers
            WHERE is_supp_active = 'YES'
        ";
        $stmt = $this->db->prepare($query);
        $stmt->execute();
        $allSuppliers = $stmt->fetchAll();
        return $allSuppliers;
    }
}
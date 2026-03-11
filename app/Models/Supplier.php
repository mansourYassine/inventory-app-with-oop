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

    public function create(string $supplierName, string $supplierEmail, string $supplierPhone, string $supplierAddress) 
    {
        $query = "
            INSERT INTO suppliers (supplier_name, supplier_email, supplier_phone, supplier_address)
            VALUES (:supplier_name, :supplier_email, :supplier_phone, :supplier_address);
        ";
        $stmt = $this->db->prepare($query);
        $stmt->execute([
            ':supplier_name' => $supplierName,
            ':supplier_email' => $supplierEmail,
            ':supplier_phone' => $supplierPhone,
            ':supplier_address' => $supplierAddress
        ]);
    }
}
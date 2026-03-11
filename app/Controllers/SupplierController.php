<?php

declare(strict_types=1);

namespace App\Controllers;

use App\View;

class SupplierController extends BaseController
{
    private array $suppliers;
    public function __construct()
    {
        parent::__construct();
        $this->suppliers = $this->supplier->getAll();
    }

    public function index(): View
    {
        return View::make('suppliers/index', ['suppliers' => $this->suppliers]);
    }

    public function add(): View {
        return View::make('suppliers/add');
    }

    public function store() {
        // Prepare supplier's data to store it

        // Check if product name doesn't already exist
        $suppliersNames = array_map(function ($supplier) {
            return $supplier['supplier_name'];
        }, $this->suppliers);
        $isSupplierExist = false;
        foreach ($suppliersNames as $supplierName) {
            if (strcmp(strtolower($_POST['supplier_name']), strtolower($supplierName)) === 0) {
                $isSupplierExist = true;
            }
        }
        $supplierName = "";
        if ($isSupplierExist === false) {
            $supplierName = $_POST['supplier_name'];
        } else {
            echo ('<h1>Supplier name already existed</h1>');
            die;
        }

        $supplierEmail = $_POST['supplier_email'];
        $supplierPhone = $_POST['supplier_phone'];
        $supplierAddress = $_POST['supplier_address'];

        $this->supplier->create($supplierName, $supplierEmail, $supplierPhone, $supplierAddress);

        header('Location: /suppliers');
        exit();
    }

    public function showInfo(): View {
        $supplierId = intval($_POST['supplier_id']);
        $supplierInfo = $this->supplier->find($supplierId);
        return View::make('suppliers/info', ['supplierInfo' => $supplierInfo]);
    }

    public function remove() {
        $supplierId = intval($_POST['delete_supplier_id']);
        $this->supplier->delete($supplierId);
        header('Location: /suppliers');
        exit();
    }

    public function edit(): View {
        return View::make('');
    }

    public function update() {

    }
}
<?php

declare(strict_types=1);

namespace App\Controllers;

use App\Models\StockMovement;
use App\View;

class StockMovementController extends BaseController
{
    private StockMovement $stockMovement;
    private array $stockMovements;
    private array $products;
    public function __construct()
    {
        $this->stockMovement = new StockMovement();
        $this->stockMovements = $this->stockMovement->getAll();
        parent::__construct();
        $this->products = $this->product->getAll();
    }

    public function index(): View
    {
        return View::make('stock-movements/index', ['stockMovements' => $this->stockMovements]);
    }

    public function add(): View 
    {
        return View::make('stock-movements/add', ['products' => $this->products]);
    }

    public function store() 
    {
        // Prepare parameters for the addNewStockMovement function
        $productId = intval($_POST['product_id']);
        $movementQuantity = intval($_POST['movement_quantity']);
        $movementType = $_POST['movement_type'];
        $movementDate = $_POST['movement_date'];

        $this->stockMovement->create($productId, $movementQuantity, $movementType, $movementDate);
        header('Location: /stock-movements');
        exit();
    }

    public function showInfo(): View 
    {
        return View::make('stock-movements/index');
    }

    public function remove() 
    {

    }

    public function edit(): View 
    {
        return View::make('stock-movements/index');
    }

    public function update() 
    {

    }
}
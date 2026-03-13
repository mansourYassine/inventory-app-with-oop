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
        $stockMovementId = intval($_POST['stock_movement_id']);
        $stockMovementInfo = $this->stockMovement->find($stockMovementId);
        return View::make('stock-movements/info', ['stockMovementInfo' => $stockMovementInfo]);
    }

    public function remove() 
    {
        $stockMovementToDeleteId = intval($_POST['delete_stock_movement_id']);
        $stockMovementInfo = $this->stockMovement->find($stockMovementToDeleteId);
        $this->stockMovement->delete(
            $stockMovementInfo['stock_movement_id'],
            $stockMovementInfo['product_id'],
            $stockMovementInfo['movement_type'],
            $stockMovementInfo['movement_quantity']                    
        );
        header('Location: /stock-movements');
        exit();
    }

    public function edit(): View 
    {
        return View::make('stock-movements/index');
    }

    public function update() 
    {

    }
}
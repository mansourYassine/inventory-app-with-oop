<?php

declare(strict_types=1);

namespace App\Models;

use App\Model;
use Exception;

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

    public function create(int $productId, int $movementQuantity, string $movementType, string $movementDate)
    {
        try {
            $this->db->beginTransaction();

            $insertMovementQuery = "
                INSERT INTO stock_movements (product_id, movement_quantity, movement_type, movement_date)
                VALUE (:product_id, :movement_quantity, :movement_type, :movement_date);
            ";
            $stmt1 = $this->db->prepare($insertMovementQuery);
            $stmt1->execute([
                ':product_id' => $productId,
                ':movement_quantity' => $movementQuantity,
                ':movement_type' => $movementType,
                ':movement_date' => $movementDate
            ]);
            
            // Change the quantity of the product in the products table
            if (strcmp($movementType, 'IN') === 0) {
                $updateProductQuery = "
                    UPDATE products
                    SET product_quantity = product_quantity + :movement_quantity
                    WHERE product_id = :product_id;
                ";
            } else {
                $updateProductQuery = "
                    UPDATE products
                    SET product_quantity = product_quantity - :movement_quantity
                    WHERE product_id = :product_id;
                ";
            }
            $stmt2 = $this->db->prepare($updateProductQuery);
            $stmt2->execute([
                ':product_id' => $productId,
                ':movement_quantity' => $movementQuantity,
            ]);

            $this->db->commit();
        } catch (Exception $e) {
            $this->db->rollBack();
            echo "<h1>Transaction failed!</h1>";
            exit();
        }
    }

    public function find(int $stockMovementId)
    {
        $query = "
            SELECT 
                s.stock_movement_id, 
                s.product_id, 
                p.product_name, 
                s.movement_quantity, 
                s.movement_type, 
                s.movement_date
            FROM stock_movements s
            JOIN products p
            ON s.product_id = p.product_id
            WHERE stock_movement_id = ?;";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$stockMovementId]);
        $stockMovementInfo = $stmt->fetch();
        return $stockMovementInfo;
    }
    
    public function delete(int $stockMovementId, int $productId, string $movementType, int $movementQuantity)
    {
        try {
            $this->db->beginTransaction();
    
            $deleteMovementQuery = "
                DELETE FROM stock_movements
                WHERE stock_movement_id = ?;
            ";
            $stmt1 = $this->db->prepare($deleteMovementQuery);
            $stmt1->execute([$stockMovementId]);
    
            // Restore the quantity of the product in the products table
            if (strcmp($movementType, 'IN') === 0) {
                $updateProductQuery = "
                    UPDATE products
                    SET product_quantity = product_quantity - :movement_quantity
                    WHERE product_id = :product_id;
                ";
            } else {
                $updateProductQuery = "
                    UPDATE products
                    SET product_quantity = product_quantity + :movement_quantity
                    WHERE product_id = :product_id;
                ";
            }
            $stmt2 = $this->db->prepare($updateProductQuery);
            $stmt2->execute([
                ':product_id' => $productId,
                ':movement_quantity' => $movementQuantity,
            ]);
    
            $this->db->commit();
        } catch (\Exception) {
            $this->db->rollBack();
            echo "<h1>Transaction failed!</h1>";
            exit();
        }
    }

    public function edit(    
        int $stockMovementId, 
        int $newProductId, 
        int $newMovementQuantity, 
        string $newMovementType, 
        string $newMovementDate, 
        array $oldMovementInfo) 
    {
        $oldProductId = intval($oldMovementInfo['product_id']);
        $oldMovementType = $oldMovementInfo['movement_type'];
        $oldMovementQuantity = intval($oldMovementInfo['movement_quantity']);

        try {
            $this->db->beginTransaction();

            // Restore the quantity of the product in the products table
            if (strcmp($oldMovementType, 'IN') === 0) {
                $updateProductQuery = "
                    UPDATE products
                    SET product_quantity = product_quantity - :movement_quantity
                    WHERE product_id = :product_id;
                ";
            } else {
                $updateProductQuery = "
                    UPDATE products
                    SET product_quantity = product_quantity + :movement_quantity
                    WHERE product_id = :product_id;
                ";
            }

            $stmt1 = $this->db->prepare($updateProductQuery);
            $stmt1->execute([
                ':product_id' => $oldProductId,
                ':movement_quantity' => $oldMovementQuantity,
            ]);

            // Update the stock movement with new values
            $updateStockMovementQuery = "
                UPDATE stock_movements
                SET 
                    product_id = :product_id,
                    movement_quantity = :movement_quantity,
                    movement_type = :movement_type,
                    movement_date = :movement_date
                WHERE stock_movement_id = :stock_movement_id;
            ";

            $stmt2 = $this->db->prepare($updateStockMovementQuery);
            $stmt2->execute([
                ':product_id' => $newProductId,
                ':movement_quantity' => $newMovementQuantity,
                ':movement_type' => $newMovementType,
                ':movement_date' => $newMovementDate,
                ':stock_movement_id' => $stockMovementId
            ]);

            // Update the quantity of the product in the products table
            if (strcmp($newMovementType, 'IN') === 0) {
                $updateProductQuery2 = "
                    UPDATE products
                    SET product_quantity = product_quantity + :movement_quantity
                    WHERE product_id = :product_id;
                ";
            } else {
                $updateProductQuery2 = "
                    UPDATE products
                    SET product_quantity = product_quantity - :movement_quantity
                    WHERE product_id = :product_id;
                ";
            }

            $stmt3 = $this->db->prepare($updateProductQuery2);
            $stmt3->execute([
                ':product_id' => $newProductId,
                ':movement_quantity' => $newMovementQuantity,
            ]);

            $this->db->commit();
        } catch (\Exception) {
            $this->db->rollBack();
            echo "<h1>Transaction failed!</h1>";
            exit();
        }

    }
}

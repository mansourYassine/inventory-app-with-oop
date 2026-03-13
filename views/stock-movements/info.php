<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Stock Movement Info</title>
        <link rel="stylesheet" href="\assets\css\master.css">
        <link rel="stylesheet" href="\assets\css\all.min.css">
    </head>
    <body>
        <h1>Stock Movement info Page</h1>
        <ul>
            <li>Product Name : <?= $stockMovementInfo['product_name'] ?></li>
            <li>Movement Type : <?= $stockMovementInfo['movement_type'] ?></li>
            <li>Movement Quantity : <?= $stockMovementInfo['movement_quantity'] ?></li>
            <li>Movement Date : <?= $stockMovementInfo['movement_date'] ?></li>
        </ul>
        <form action="/stock_movements/edit" method="post">
            <input type="hidden" name="edit_stock_movement_id" value="<?= $stockMovementInfo['stock_movement_id'] ?>">
            <button type="submit">Edit</button>
        </form>
        <form action="/stock-movements/delete" method="post">
            <input type="hidden" name="delete_stock_movement_id" value="<?= $stockMovementInfo['stock_movement_id'] ?>">
            <button type="submit">Delete</button>
        </form>
    </body>
</html>
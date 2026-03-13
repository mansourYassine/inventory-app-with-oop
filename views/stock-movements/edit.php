<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Edit Stock Movement page</h1>
    <form action="/stock-movements/edit/save" method="post">
        <input type="hidden" name="stock_movement_id" value="<?= $stockMovementInfo['stock_movement_id'] ?>">
        <div>
            <label for="">Product Name</label>
            <select name="product_id" id="">
                <?php foreach ($products as $product) :?>
                    <?php if (strcmp($product['product_id'], $stockMovementInfo['product_id']) === 0) :?>
                        <option value="<?= $product['product_id'] ?>" selected><?= $product['product_name'] ?></option>
                    <?php else :?>
                        <option value="<?= $product['product_id'] ?>"><?= $product['product_name'] ?></option>
                    <?php endif; ?>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <label for="">Movement Type</label>
            <?php if (strcmp($stockMovementInfo['movement_type'], 'IN') === 0) :?>
                <input type="radio" name="movement_type" value="IN" checked> In
                <input type="radio" name="movement_type" value="OUT"> Out
            <?php else : ?>
                <input type="radio" name="movement_type" value="IN"> In
                <input type="radio" name="movement_type" value="OUT" checked> Out
            <?php endif ?>
        </div>
        <div>
            <label for="">Movement Quantity</label>
            <input type="number" name="movement_quantity" id="" value="<?= $stockMovementInfo['movement_quantity'] ?>">
        </div>
        <div>
            <label for="">Movement Date</label>
            <input type="datetime-local" name="movement_date" id="" value="<?= $stockMovementInfo['movement_date'] ?>">
        </div>
        <div>
            <input type="submit" value="Save">
            <input type="reset" value="Reset">
        </div>
    </form>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php require VIEWS_PATH . 'includes\header.php' ?>
    <?php require VIEWS_PATH . 'includes\navbar.php' ?>
    <h1>Add Stock Movement page</h1>
    <form action="" method="post">
        <div>
            <label for="">Product Name</label>
            <select name="product_id" id="" required>
                <?php foreach ($products as $product) :?>
                    <option value="<?= $product['product_id'] ?>"><?= $product['product_name'] ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div>
            <label for="">Movement Type</label>
            <input type="radio" name="movement_type" value="IN" checked> In
            <input type="radio" name="movement_type" value="OUT"> Out
        </div>
        <div>
            <label for="">Movement Quantity</label>
            <input type="number" name="movement_quantity" id="" required>
        </div>
        <div>
            <label for="">Movement Date</label>
            <input type="datetime-local" name="movement_date" id="" min="0" required>
        </div>
        <div>
            <input type="submit" value="Save">
            <input type="reset" value="Reset">
        </div>
    </form>
</body>
</html>
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
    <h1>Add product page</h1>

    <form action="" method="post">
        <div>
            <label for="">Product Name</label>
            <input type="text" name="product_name" id="" required>
        </div>
        <div>
            <label>Category Name</label>
            <select name="category_id">
                <?php foreach ($allCategories as $category) :?>
                    <option value="<?= $category['category_id'] ?>"><?= $category['category_name'] ?></option>
                <?php endforeach?>
            </select>
        </div>
        <div>
            <label>Supplier Name</label>
            <select name="supplier_id">
                <?php foreach ($allSuppliers as $supplier) :?>
                    <option value="<?= $supplier['supplier_id'] ?>"><?= $supplier['supplier_name'] ?></option>
                <?php endforeach;?>
            </select>
        </div>
        <div>
            <label for="">Product Quantity</label>
            <input type="number" name="product_quantity" id="" min="0" required>
        </div>
        <div>
            <label for="">Product Price</label>
            <input type="number" name="product_price" step="0.01" id="" min="0" required>
        </div>
        <div>
            <input type="submit" value="Add">
            <input type="reset" value="Reset">
        </div>
    </form>
</body>
</html>
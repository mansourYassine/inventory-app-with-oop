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
    <h1>Edit product page</h1>
    <form action="/products/edit/save" method="post">
        <input type="hidden" name="product_id" value="<?= $productInfo['product_id'] ?>">
        <div>
            <label for="">Product Name</label>
            <input type="text" name="product_name" id="" value="<?= $productInfo['product_name'] ?>">
        </div>
        <div>
            <label>Category Name</label>
            <select name="category_id">
                <?php foreach ($allCategories as $category) :?>
                    <?php if (strcmp($category['category_id'], $productInfo['category_id']) === 0) :?>
                        <option value="<?= $category['category_id'] ?>" selected><?= $category['category_name'] ?></option>
                    <?php else :?>
                        <option value="<?= $category['category_id'] ?>"><?= $category['category_name'] ?></option>
                    <?php endif ?>
                <?php endforeach?>
            </select>
        </div>
        <div>
            <label>Supplier Name</label>
            <select name="supplier_id">
                <?php foreach ($allSuppliers as $supplier) :?>
                    <?php if (strcmp($supplier['supplier_id'], $productInfo['supplier_id']) === 0) :?>
                        <option value="<?= $supplier['supplier_id'] ?>" selected><?= $supplier['supplier_name'] ?></option>
                    <?php else :?>
                        <option value="<?= $supplier['supplier_id'] ?>"><?= $supplier['supplier_name'] ?></option>
                    <?php endif ?>
                <?php endforeach;?>
            </select>
        </div>
        <div>
            <label for="">Product Quantity</label>
            <input type="number" name="product_quantity" id="" value="<?= $productInfo['product_quantity'] ?>">
        </div>
        <div>
            <label for="">Product Price</label>
            <input type="number" name="product_price" step="0.01" id="" value="<?= $productInfo['product_price'] ?>">
        </div>
        <div>
            <input type="submit" value="Save">
            <input type="reset" value="Reset">
        </div>
    </form>
</body>
</html>
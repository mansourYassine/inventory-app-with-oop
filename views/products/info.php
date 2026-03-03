<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Product Info</title>
    </head>
    <body>
        <h1>Product info Page</h1>
        <ul>
            <li>Product Name : <?= $productInfo['product_name'] ?></li>
            <li>Category Name : <?= $productInfo['category_name'] ?></li>
            <li>Supplier Name : <?= $productInfo['supplier_name'] ?></li>
            <li>Product Quantity : <?= $productInfo['product_quantity'] ?></li>
            <li>Product Price : <?= $productInfo['product_price'] ?></li>
        </ul>
        <form action="/products/edit" method="post">
            <input type="hidden" name="edit_product_id" value="<?= $productInfo['product_id'] ?>">
            <button type="submit">Edit</button>
        </form>
        <form action="/products/info" method="post">
            <input type="hidden" name="delete_product_id" value="<?= $productInfo['product_id'] ?>">
            <button type="submit">delete</button>
        </form>
    </body>
</html>
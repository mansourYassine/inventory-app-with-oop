<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products page</title>
</head>
<body>
    <h1>Products Page</h1>
    <a href="/products/add">Add New Product</a>
    <table border="1">
        <?php foreach ($allProducts as $product):?>
            <?php if (strcmp($product['is_active'], 'YES') === 0):?>
                <tr>
                    <td><?= $product['product_name'] ?></td>
                    <td><?= $product['category_name'] ?></td>
                    <td><?= $product['supplier_name'] ?></td>
                    <td><?= $product['product_quantity'] ?></td>
                    <td><?= $product['product_price'] ?></td>
                    <td>
                        <form action="/products/info" method="post">
                            <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">
                            <button type="submit">More Info</button>
                        </form>
                    </td>
                </tr>
            <?php endif ?>
        <?php endforeach?>
    </table>
</body>
</html>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard Page</title>
    </head>
    <body>
        <?php require VIEWS_PATH . 'includes\header.php' ?>
        <?php require VIEWS_PATH . 'includes\navbar.php' ?>
        <h1>Dashboard Page</h1>
        <ul>
            <li>Total number of products: <?= $totalProductsNumber ?></li>
            <li>Total quantity : <?= $totalProductsQuantity ?></li>
            <li>Total value : <?= $totalProductsValue ?></li>
        </ul>
        <h3>Low stock products</h3>
        <table border="1">
            <tr>
                <th>Product Name</th>
                <th>Product Quantity</th>
            </tr>
            <?php foreach ($lowStockProducts as $product) :?>
                <tr>
                    <td><?= $product['product_name'] ?></td>
                    <td><?= $product['product_quantity'] ?></td>
                </tr>
            <?php endforeach ?>
        </table>
    </body>
</html>
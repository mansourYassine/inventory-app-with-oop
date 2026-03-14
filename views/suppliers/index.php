<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suppliers page</title>
</head>
<body>
    <?php require VIEWS_PATH . 'includes\header.php' ?>
    <?php require VIEWS_PATH . 'includes\navbar.php' ?>
    <h1>Suppliers Page</h1>
    <a href="/suppliers/add">Add New Supplier</a>
    <table border="1">
        <?php foreach ($suppliers as $supplier):?>
            <?php if (strcmp($supplier['is_supp_active'], 'YES') === 0):?>
                <tr>
                    <td><?= $supplier['supplier_name'] ?></td>
                    <td><?= $supplier['supplier_email'] ?></td>
                    <td><?= $supplier['supplier_phone'] ?></td>
                    <td><?= $supplier['supplier_address'] ?></td>
                    <td>
                        <form action="/suppliers/info" method="post">
                            <input type="hidden" name="supplier_id" value="<?= $supplier['supplier_id'] ?>">
                            <button type="submit">More Info</button>
                        </form>
                    </td>
                </tr>
            <?php endif ?>
        <?php endforeach?>
    </table>
</body>
</html>
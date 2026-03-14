<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Supplier Info</title>
        <link rel="stylesheet" href="\assets\css\master.css">
        <link rel="stylesheet" href="\assets\css\all.min.css">
    </head>
    <body>
        <?php require VIEWS_PATH . 'includes\header.php' ?>
        <?php require VIEWS_PATH . 'includes\navbar.php' ?>
        <h1>Supplier info Page</h1>
        <ul>
            <li>Supplier Name : <?= $supplierInfo['supplier_name'] ?></li>
            <li>Supplier Email : <?= $supplierInfo['supplier_email'] ?></li>
            <li>Supplier Phone : <?= $supplierInfo['supplier_phone'] ?></li>
            <li>Supplier Address : <?= $supplierInfo['supplier_address'] ?></li>
        </ul>
        <form action="/suppliers/edit" method="post">
            <input type="hidden" name="edit_supplier_id" value="<?= $supplierInfo['supplier_id'] ?>">
            <button type="submit">Edit</button>
        </form>
        <form action="/suppliers/delete" method="post">
            <input type="hidden" name="delete_supplier_id" value="<?= $supplierInfo['supplier_id'] ?>">
            <button type="submit">Delete</button>
        </form>
    </body>
</html>
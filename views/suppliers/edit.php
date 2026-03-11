<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Edit Supplier page</h1>
    <form action="/suppliers/edit/save" method="post">
        <input type="hidden" name="supplier_id" value="<?= $supplierInfo['supplier_id'] ?>">
        <div>
            <label for="">Supplier Name</label>
            <input type="text" name="supplier_name" id="" value="<?= $supplierInfo['supplier_name'] ?>">
        </div>
        <div>
            <label for="">Supplier Email</label>
            <input type="email" name="supplier_email" id="" value="<?= $supplierInfo['supplier_email'] ?>">
        </div>
        <div>
            <label for="">Supplier Phone</label>
            <input type="tel" name="supplier_phone" id="" value="<?= $supplierInfo['supplier_phone'] ?>">
        </div>
        <div>
            <label for="">Supplier Address</label>
            <input type="text" name="supplier_address" id="" value="<?= $supplierInfo['supplier_address'] ?>">
        </div>
        <div>
            <input type="submit" value="Save">
            <input type="reset" value="Reset">
        </div>
    </form>
</body>
</html>
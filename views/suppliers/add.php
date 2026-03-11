<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Add Supplier Page</h1>

    <form action="/suppliers/add" method="post">
        <div>
            <label for="">Supplier Name</label>
            <input type="text" name="supplier_name" id="" required>
        </div>
        <div>
            <label for="">Supplier Email</label>
            <input type="email" name="supplier_email" id="" required>
        </div>
        <div>
            <label for="">Supplier Phone</label>
            <input type="tel" name="supplier_phone" id="" required>
        </div>
        <div>
            <label for="">Supplier Address</label>
            <input type="text" name="supplier_address" id="" required>
        </div>
        <div>
            <input type="submit" value="Add">
            <input type="reset" value="Reset">
        </div>
    </form>
</body>
</html>
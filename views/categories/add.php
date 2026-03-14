<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category</title>
</head>
<body>
    <?php require VIEWS_PATH . 'includes\header.php' ?>
    <?php require VIEWS_PATH . 'includes\navbar.php' ?>
    <h1>Add Category Page</h1>

    <form action="" method="post">
        <div>
            <label for="">Category Name</label>
            <input type="text" name="category_name" id="" required>
        </div>
        <div>
            <input type="submit" value="Add">
            <input type="reset" value="Reset">
        </div>
    </form>
</body>
</html>
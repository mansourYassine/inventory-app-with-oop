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
    <h1>Edit Category page</h1>
    <form action="/categories/edit/save" method="post">
        <input type="hidden" name="category_id" value="<?= $categoryInfo['category_id'] ?>">
        <div>
            <label for="">Category Name</label>
            <input type="text" name="category_name" id="" value="<?= $categoryInfo['category_name'] ?>">
        </div>
        <div>
            <input type="submit" value="Save">
            <input type="reset" value="Reset">
        </div>
    </form>
</body>
</html>
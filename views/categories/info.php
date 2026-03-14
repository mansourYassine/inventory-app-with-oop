<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Category Info</title>
        <link rel="stylesheet" href="\assets\css\master.css">
        <link rel="stylesheet" href="\assets\css\all.min.css">
    </head>
    <body>
    <?php require VIEWS_PATH . 'includes\header.php' ?>
    <?php require VIEWS_PATH . 'includes\navbar.php' ?>
        <h1>Category info Page</h1>
        <ul>
            <li>Category Name : <?= $categoryInfo['category_name'] ?></li>
        </ul>
        <form action="/categories/edit" method="post">
            <input type="hidden" name="edit_category_id" value="<?= $categoryInfo['category_id'] ?>">
            <button type="submit">Edit</button>
        </form>
        <form action="/categories/delete" method="post">
            <input type="hidden" name="delete_category_id" value="<?= $categoryInfo['category_id'] ?>">
            <button type="submit">Delete</button>
        </form>
    </body>
</html>
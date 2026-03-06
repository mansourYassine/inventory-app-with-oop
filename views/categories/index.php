<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>
</head>
<body>
    <h1>Categories Page</h1>
    <a href="/categories/add">Add New Category</a>
    <table border="1">
        <?php foreach ($categories as $category):?>
            <?php if (strcmp($category['is_categ_active'], 'YES') === 0):?>
                <tr>
                    <td><?= $category['category_name'] ?></td>
                    <td>
                        <form action="/categories/info" method="post">
                            <input type="hidden" name="category_id" value="<?= $category['category_id'] ?>">
                            <button type="submit">More Info</button>
                        </form>
                    </td>
                </tr>
            <?php endif?>
        <?php endforeach?>
    </table>
</body>
</html>
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
    <br>
    <br>
    <!-- Filter by category -->
    <label for="filter-category">Filter By Category:</label>
    <select name="category_id" id="filter-category">
        <option value="-1">--Choose a category--</option>
        <?php foreach ($allCategories as $category) :?>
            <?php if (strcmp($category['category_id'], $_POST['category_id']) === 0) :?>
                <option value="<?= $category['category_id'] ?>" selected><?= $category['category_name'] ?></option>
                <?php else :?>
                <option value="<?= $category['category_id'] ?>"><?= $category['category_name'] ?></option>
            <?php endif ?>
        <?php endforeach ?>
    </select>
    <!-- Filter by supplier -->
    <label for="filter-supplier">Filter By Supplier:</label>
    <select name="supplier_id" id="filter-supplier">
        <option value="-1">--Choose a supplier--</option>
        <?php foreach ($allSuppliers as $supplier) :?>
            <?php if (strcmp($supplier['supplier_id'], $_POST['supplier_id']) === 0) :?>
                <option value="<?= $supplier['supplier_id'] ?>" selected><?= $supplier['supplier_name'] ?></option>
                <?php else :?>
                <option value="<?= $supplier['supplier_id'] ?>"><?= $supplier['supplier_name'] ?></option>
            <?php endif ?>
        <?php endforeach ?>
    </select>
    <br>
    <br>
    <br>
    <table border="1">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Category</th>
                <th>Supplier</th>
                <th>Quantity</th>
                <th>Price</th>
                <th>More Info</th>
            </tr>
        </thead>
        <tbody id="table-body">
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
        </tbody>
    </table>
    <script>
        var products = <?= $jsonProducts ?>;

        function displayProducts(listProducts = products) {
            document.getElementById("table-body").innerHTML = "";
            for (let product of listProducts) {
                if (product.is_active === 'YES') {
                    document.getElementById("table-body").innerHTML += `
                        <tr>
                            <td>${product.product_name}</td>
                            <td>${product.category_name}</td>
                            <td>${product.supplier_name}</td>
                            <td>${product.product_quantity}</td>
                            <td>${product.product_price}</td>
                            <td>
                                <form action="/products/info" method="post">
                                    <input type="hidden" name="product_id" value="${product.product_id}">
                                    <button type="submit">More Info</button>
                                </form>
                            </td>
                        </tr>
                    `;
                }
            }
        }

        var filterdProducts = [];
        
        const filterBySuppliers = document.getElementById('filter-supplier');
        filterBySuppliers.addEventListener("input", function() {
            let supplierIDToFilter = Number(event.target.value);
            if (supplierIDToFilter !== -1){
                filterdProducts = [];
                for (let product of products) {
                    if (product.supplier_id === supplierIDToFilter) {
                        filterdProducts.push(product);
                    }
                    displayProducts(filterdProducts);
                }
            } else {
                displayProducts();
            }
        });

        const filterByCategories = document.getElementById('filter-category');
        filterByCategories.addEventListener("input", function() {
            let categoryIDToFilter = Number(event.target.value);
            if (categoryIDToFilter !== -1){
                filterdProducts = [];
                for (let product of products) {
                    if (product.category_id === categoryIDToFilter) {
                        filterdProducts.push(product);
                    }
                    displayProducts(filterdProducts);
                }
            } else {
                displayProducts();
            }
        });
    </script>
</body>
</html>
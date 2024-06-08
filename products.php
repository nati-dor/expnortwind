<?php 
require_once 'autoload_nortwind.php';
session_start();

$user             = user::get_username();
$user_customer_id = user::get_customer_id();
if (!isset($user) && !isset($user_customer_id))
{
    header("Location: ./");
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles/nortwind.css">
    <title>Nortwind</title>
</head>
<body>
    <div class="c-navbar">
        <a href="./products.php">Products</a>
        <a href="./orders.php">Orders</a>
        <button onclick="user.logoutUser()">Log Out</button>
    </div>
    <h2 style="text-align: center;">Products</h2>
    <div id="id-container" class="c-container">
        <div>
            <form id="id-form-products" onsubmit="products.fillterTable(event)">
                <label>Category: </label>
                <select id="id-categories" name='categories'>
                    <option value="0">All</option>
                    <?php
                        $categories = categories::get_all_categories();
                        for ($i=0; $i < count($categories); $i++) { 
                            $str_category_id   = $categories[$i]['CategoryID'];
                            $str_category_name = $categories[$i]['CategoryName'];
                           echo "<option value=$str_category_id>$str_category_name</option>";
                        }
                    ?>
                </select>
                <label>Suppliers: </label>
                <select id="id-suppliers" name='suppliers'>
                    <option value="0">All</option>
                    <?php
                        $suppliers = suppliers::get_all_suppliers();
                        for ($i=0; $i < count($suppliers); $i++) { 
                            $str_supplier_id   = $suppliers[$i]['SupplierID'];
                            $str_company_name  = $suppliers[$i]['CompanyName'];
                           echo "<option value=$str_supplier_id>$str_company_name</option>";
                        }
                    ?>
                </select>
                <button>Fillter</button>
            </form>
            <div>
                <label>Search: </label>
                <input id="id-search-products" oninput="products.buildTbodyProducts()"/>
            </div>
            <table id="id-table-products">
                <thead>
                    <tr>
                        <th>Product ID</th>
                        <th>Product</th>
                        <th>Category</th>
                        <th>Company</th>
                        <th>Quantity Per Unit</th>
                        <th>Unit Price</th>
                        <th>Units In Stock</th>
                        <th>Units On Order</th>
                        <th>Reorder Level</th>
                        <th>Discontinued</th>
                    </tr>
                </thead>
                <tbody id="id-tbody-products">
                </tbody>
            </table>
        </div>
    </div>
    <script>
        function $$(i) {return document.getElementById(i);}
        let productsArr = [];
    </script>
    <script src="./js/nanoajax.min.js"></script>
    <script src="./js/sweet-alert.min.js"></script>
    <script src="./js/products.js"></script>
    <script src="./js/user.js"></script>
    <script>
        products.getProductsWithFillter(0,0);
    </script>
</body>
</html>
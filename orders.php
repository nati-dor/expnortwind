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
    <h2 style="text-align: center;">Orders</h2>
    <div id="id-container" class="c-container">
            <table>
                <thead>
                    <tr>
                        <th>Order ID</th>
                        <th>Customer ID</th>
                        <th>Employee ID</th>
                        <th>Order Date</th>
                        <th>Required Date</th>
                        <th>Freight</th>
                        <th>Ship Name</th>
                        <th>Ship Address</th>
                        <th>Ship City</th>
                        <th>Ship Country</th>
                    </tr>
                </thead>
                <tbody id="id-tbody-orders">
                </tbody>
            </table>
        </div>
    </div>
    <script>
        function $$(i) {return document.getElementById(i);}
        let ordersArr = [];
    </script>
    <script src="./js/nanoajax.min.js"></script>
    <script src="./js/sweet-alert.min.js"></script>
    <script src="./js/orders.js"></script>
    <script src="./js/user.js"></script>

    <script>
        orders.getOrdersCustomer();
    </script>
</body>
</html>
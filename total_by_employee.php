<?php 
require_once 'autoload_nortwind.php';
session_start();

$user             = user::get_username();
$user_employee_id = user::get_employee_id();
if (!isset($user) && !isset($user_employee_id))
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
        <a href="./total_by_customer.php">Total By Customer</a>
        <a href="./total_by_employee.php">Total By Employee</a>
        <button onclick="user.logoutUser()">Log Out</button>
    </div>
    <h2 style="text-align: center;">Total By Customer</h2>
    <div id="id-container" class="c-container">
            <table>
                <thead>
                    <tr>
                        <th>Employee ID</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody id="id-tbody-total-by-customer">
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
    <script src="./js/employee.js"></script>
    <script src="./js/user.js"></script>

    <script>
        employee.getTotalByEmployee();
    </script>
</body>
</html>
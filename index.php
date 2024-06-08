<?php 
require_once 'autoload_nortwind.php';
session_start();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Nortwind</title>
</head>
<body>
    <div id="id-container-login" class="c-container-login">
        <form id="id-form-login" class="c-form-login" onsubmit="event.preventDefault(); user.loginUser(event);">
            <table>
                <tr>
                    <td>User Name:</td>
                    <td><input id="id-username-login" name="username" value=""></td>
                </tr>
                <tr>
                    <td>Password:</td>
                    <td><input type="password" id="id-password-login" name="password" value=""></td>
                </tr>
                <tr>
                    <td colspan="4" style="text-align: center;">
                        <select name="userselect" id="id-user">
                            <option value="admin">Admin</option>
                            <option value="customer">Customer</option>
                            <option value="employee">Employee</option>
                        </select>
                    </td>
                </tr>
                <tr><td colspan="2" style="text-align: center;"><button type="submit" class="c-login-btn">Login</button></td></tr>
            </table>

        </form>
    </div>
    <script>
        function $$(i) {return document.getElementById(i);}
    </script>
    <script src="./js/nanoajax.min.js"></script>
    <script src="./js/sweet-alert.min.js"></script>
    <script src="./js/user.js" async defer></script>
</body>
</html>
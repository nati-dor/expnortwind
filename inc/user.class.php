<?php

class user
{
    public static function get_username()
    {
        return $_SESSION['user_logged'] ?? null;
    }

    public static function get_customer_id()
    {
        return $_SESSION['customer_id'] ?? null;
    }

    public static function get_employee_id()
    {
        return $_SESSION['employee_id'] ?? null;
    }

    public static function set_username_session($username)
    {
        $_SESSION['user_logged'] = $username;
    }

    public static function set_customer_id($customer_id)
    {
        $_SESSION['customer_id'] = $customer_id;
    }
    
    public static function set_employee_id($employee_id)
    {
        $_SESSION['employee_id'] = $employee_id;
    }

    public static function login_username_password($username, $password)
    {

        $mysqli = db::master();

        if ($mysqli->connect_error)
            die("Connection failed: " . $mysqli->connect_error);

        $sql = "SELECT * FROM users
                WHERE username='$username'";

        $result = $mysqli->query($sql);

        $data   = $result->fetch_assoc();

        if (isset($data) && password_verify($password, $data['password']))
        {
            self::set_username_session($data['username']);
            self::set_customer_id('0');
            $response = ['user' => $data['username']] ;
            return $response;
        }
        return $response = ["error" => 'Wrong username or password'];
    }

    public static function login_customer($username)
    {

        $mysqli = db::master();

        if ($mysqli->connect_error)
            die("Connection failed: " . $mysqli->connect_error);

        $sql = "SELECT * FROM customers
                WHERE CustomerID='$username'";

        $result = $mysqli->query($sql);

        $data   = $result->fetch_assoc();

        if(isset($data))
        {
            self::set_customer_id($data['CustomerID']);
            $response = ['user' => $data['CustomerID']] ;
            return $response;
        }
        return $response = ["error" => 'Wrong Customer ID'];
    }

    public static function login_employee($username)
    {

        $mysqli = db::master();

        if ($mysqli->connect_error)
            die("Connection failed: " . $mysqli->connect_error);

        $sql = "SELECT * FROM employees
                WHERE EmployeeID = '$username'";
        $result = $mysqli->query($sql);

        $data   = $result->fetch_assoc();
        if(isset($data))
        {
            self::set_employee_id($data['EmployeeID']);
            $response = ['user' => $data['EmployeeID']] ;
            return $response;
        }
        return $response = ["error" => 'Wrong username or password'];
    }

    public static function remove_session()
    {
        session_unset();
        return true;
    }

}
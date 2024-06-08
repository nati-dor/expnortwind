<?php

class orders
{
    public static function get_orders_customer()
    {
        $customer_id = user::get_customer_id();
        $mysqli      = db::master();
        $data        = [];
        $where       = [];
        $where_str   = '';
        if ($mysqli->connect_error)
            die("Connection failed: " . $mysqli->connect_error);

        if(isset($customer_id) && $customer_id !== '0')
            $where[] = "orders.CustomerID = '$customer_id'";
        if(count($where) > 0)
            $where_str  = " WHERE " . implode(' AND ', $where);
        $sql = "SELECT  orders.OrderID,
                        orders.CustomerID,
                        orders.EmployeeID,
                        orders.OrderDate,
                        orders.RequiredDate,
                        orders.Freight,
                        orders.ShipName,
                        orders.ShipAddress,
                        orders.ShipCity,
                        orders.ShipCountry,
                        employees.LastName,
                        employees.FirstName
                        FROM orders 
                        LEFT JOIN employees ON orders.EmployeeID = employees.EmployeeID
                        $where_str";
        $result = $mysqli->query($sql)
                        or die($mysqli->error);
      
        while($row = $result->fetch_assoc())
        {
            $data[] = $row;
        }

        $result->free();
        return $data;
    }
}
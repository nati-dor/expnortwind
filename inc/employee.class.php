<?php

class employee
{
    public static function get_total_by_customer()
    {
        $employee_id = user::get_employee_id();
        $mysqli      = db::master();
        $data        = [];
        $where       = [];
        $where_str   = '';
        if ($mysqli->connect_error)
            die("Connection failed: " . $mysqli->connect_error);

        if(isset($employee_id) && $employee_id !== '0')
            $where[] = "EmployeeID = '$employee_id'";
        if(count($where) > 0)
            $where_str  = " WHERE " . implode(' AND ', $where);
        $sql = "SELECT od.OrderID,
                        sum(od.Quantity*od.UnitPrice) as total, 
                        CustomerID,
                        EmployeeID 
                        FROM `order details` as od 
                        LEFT JOIN orders ON orders.OrderID = od.OrderID 
                        $where_str
                        GROUP BY CustomerID
                        ORDER BY total DESC";
        $result = $mysqli->query($sql)
                        or die($mysqli->error);
      
        while($row = $result->fetch_assoc())
        {
            $data[] = $row;
        }

        $result->free();
        return $data;
    }

    public static function get_total_by_employee()
    {
        $mysqli      = db::master();
        $data        = [];

        if ($mysqli->connect_error)
            die("Connection failed: " . $mysqli->connect_error);

        $sql = "SELECT  sum(od.Quantity*od.UnitPrice) as total, 
                        EmployeeID 
                        FROM `order details` as od 
                        LEFT JOIN orders ON orders.OrderID = od.OrderID 
                        GROUP BY EmployeeID
                        ORDER BY total DESC";
                        
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
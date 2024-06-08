<?php

class suppliers
{
    public static function get_all_suppliers()
    {
        $mysqli = db::master();

        if ($mysqli->connect_error)
            die("Connection failed: " . $mysqli->connect_error);

        $sql    = "SELECT * FROM suppliers";
        $result = $mysqli->query($sql);

        while($row = $result->fetch_assoc())
        {
            $data[] = $row;
        }

        $result->free();
        return $data;
    }
}
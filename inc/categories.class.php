<?php

class categories
{
    public static function get_all_categories()
    {
        $mysqli = db::master();

        if ($mysqli->connect_error)
            die("Connection failed: " . $mysqli->connect_error);

        $sql    = "SELECT * FROM categories";
        $result = $mysqli->query($sql);

        while($row = $result->fetch_assoc())
        {
            $data[] = $row;
        }

        $result->free();
        return $data;
    }
}
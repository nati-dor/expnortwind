<?php

class products
{
    public static function get_products_with_fillter($category_id, $supplier_id)
    {
        $mysqli    = db::master();
        $data      = [];
        $where     = [];
        $where_str = '';
        if ($mysqli->connect_error)
            die("Connection failed: " . $mysqli->connect_error);

        $category_id = $mysqli->real_escape_string($category_id);
        $supplier_id = $mysqli->real_escape_string($supplier_id);
        if($category_id > 0 && is_numeric($category_id))
            $where[] = "products.categoryID = '$category_id'";
        if($supplier_id > 0 && is_numeric($supplier_id))
            $where[] = "products.supplierID = '$supplier_id'";
        if(count($where) > 0)
            $where_str  = " WHERE " . implode(' AND ', $where);
        $sql = "SELECT products.ProductID,
                       products.ProductName,
                       products.QuantityPerUnit,
                       products.UnitPrice,
                       products.UnitsInStock,
                       products.UnitsOnOrder,
                       products.ReorderLevel,
                       products.Discontinued,
                       products.CategoryID,
                       categories.CategoryName,
                       suppliers.CompanyName 
                       FROM products 
                       LEFT JOIN categories ON products.CategoryID = categories.CategoryID
                       LEFT JOIN suppliers ON products.SupplierID = suppliers.SupplierID
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
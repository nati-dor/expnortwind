<?php 
require_once '../autoload_nortwind.php';
session_start();
header('Content-Type: multipart/form-data; application/json');
header('Access-Control-Allow-Methods: POST');

$request_body  = file_get_contents('php://input');
$data          = json_decode($request_body, true);
$action        = $_GET['action'];
$rv            = [];
switch ($action) 
{
    case 'getProductsWithFillter':
        $category_id    = (int)$data['categoryId'];
        $supplier_id    = (int)$data['supplierId'];
        $products       = products::get_products_with_fillter($category_id, $supplier_id);
        $rv['response'] = $products;
        break;
    default:
        $rv['error'] = 'missing an action parm for products.rpc.php';
        break;
}
die(json_encode($rv));
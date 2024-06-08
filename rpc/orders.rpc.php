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
    case 'getOrdersCustomer':
        $orders       = orders::get_orders_customer();
        $rv['response'] = $orders;
        break;
    default:
        $rv['error'] = 'missing an action parm for orders.rpc.php';
        break;
}
die(json_encode($rv));
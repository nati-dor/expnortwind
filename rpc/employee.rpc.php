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
    case 'get_total_by_customer':
        $orders       = employee::get_total_by_customer();
        $rv['response'] = $orders;
        break;
    case 'get_total_by_employee':
        $orders       = employee::get_total_by_employee();
        $rv['response'] = $orders;
        break;
    default:
        $rv['error'] = 'missing an action parm for employee.rpc.php';
        break;
}
die(json_encode($rv));


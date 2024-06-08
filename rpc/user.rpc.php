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
    case 'login':
        $user_name      = $data['user_name'];
        $password       = $data['password'];
        $user           = user::login_username_password($user_name, $password);
        $rv['response'] = $user;
        break;
    case 'login_customer':
        $user_name      = $data['user_name'];
        $user           = user::login_customer($user_name);
        $rv['response'] = $user;
        break;
    case 'login_employee':
        $user_name      = $data['user_name'];
        $user           = user::login_employee($user_name);
        $rv['response'] = $user;
        break;
    case 'logout':
        $rv['response'] = user::remove_session();
        break;
    default:
        $rv['error'] = 'missing an action parm for user.rpc.php';
        break;
}
die(json_encode($rv));
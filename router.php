<?php
require_once __DIR__ . "/controllers/AuthController.php";
require_once __DIR__ . "/controllers/userController.php";


$action = $_GET['action'] ?? 'login';
if ($_SERVER['REQUEST_METHOD'] === 'POST' || $_GET['action'] === 'auth/logout') {

    $Authcontroller = new AuthController();
    $Urcontroller = new UserController();

    switch ($action) {
        case 'auth/login':
            $Authcontroller->login();
            break;
        case 'auth/register':
            $Authcontroller->register();
            break;
        case 'auth/logout':
            $Authcontroller->logout();
            break;

        case 'edit':
            $Urcontroller->updateUser();
            break;
        case 'delete':
            $Urcontroller->delete();
            break;

        default:
            $controller->login();
            break;
    }
}

<?php
require_once __DIR__ . '/controllers/AuthController.php';
require_once __DIR__ . '/controllers/userController.php';
require_once __DIR__ . '/validator/AuthValidator.php';

$route = $_GET['route'] ?? null;
$method = $_SERVER['REQUEST_METHOD'];
// if ($method === 'POST' || $route === 'auth/logout') {

$Authcontroller = new AuthController();
$Usercontroller = new UserController();
switch ($route) {
    case 'auth/login':
        if ($method === 'POST') {
            
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            $validation = AuthValidator::loginValidation($_POST);

            $response = $Authcontroller->login($email, $password);

            if ($response['success'] == true) {
                 http_response_code($response['status_code']);
                echo json_encode(["success" => true, "message" => $response['message'], 'redirect_url' => '/collab-training/index.php?page=dashboard']);
                // header("Location: /collab-training/index.php?page=dashboard");
                exit;
            } else{
                http_response_code($response['status_code']);
                echo json_encode(["success" => false, "message" => $response['message']]);
                $_SESSION['error'] = $response['message'];
                // header("Location: /collab-training/login.php");
            }
            exit;
        }

    case 'auth/logout':
        $Authcontroller->logout();
        break;
        
    case 'auth/register':
        $Authcontroller->register();
        break;
    case 'edit':
        $Usercontroller->updateUser();
        break;
    case 'delete':
        $Usercontroller->delete();
        break;

    default:
        // header("Location: /collab-training/login.php");
        break;
    }
// }


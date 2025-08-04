<?php
require_once __DIR__ . '/controllers/AuthController.php';
require_once __DIR__ . '/controllers/userController.php';
require_once __DIR__ . '/validator/AuthValidator.php';

$route = $_GET['route'] ?? null;
$method = $_SERVER['REQUEST_METHOD'];

switch ($route) {
    case 'auth/login':
        if ($method === 'POST') {
            $authController = new AuthController();
            
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            $validation = AuthValidator::loginValidation($_POST);

            $response = $authController->login($email, $password);

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
        $authController = new AuthController;
        $authController->logout();
        break;
        
    case 'auth/register':
        $authController = new AuthController;
        $authController->register();
        break;

    case 'user/delete' :
        $userController = new UserController;
        $userController->delete();
        break;
    default:
        header('Location: /collab-training/views/404.php');
        break;
}
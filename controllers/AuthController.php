<?php 
include_once __DIR__ . "/../database/db.php";

class AuthController {
    private $connection;

    public function __construct()
    {
        $db = new Database;
        $this->connection = $db->getConnection();
    }

    public function login(){
        session_start();
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';
    
        if (empty($email) || empty($password)) {
            $_SESSION['error'] = 'Email or password is required.';
            header('Location: /collab-training/login.php');
            exit;
        }
    
        $query = "SELECT * FROM users WHERE email = ?";
        $prepareStatement = $this->connection->prepare($query);
        $prepareStatement->bind_param('s', $email);
        $prepareStatement->execute();
    
        $result = $prepareStatement->get_result();

        if ($result && $result->num_rows > 0) {
            $user = $result->fetch_assoc();

            if (password_verify($password, $user['password'])) {
                $_SESSION['user'] = [
                    "id" => $user['id'],
                    "email" => $user['email'],
                    "fullname" => $user['fullname'],
                    "username" => $user['username'],
                ];
                header('Location: /collab-training/index.php?page=dashboard');
                exit;
            }   else {
                $_SESSION['error'] = "Invalid Username Or Password.";
                header('Location: /collab-training/login.php');
                exit;
            }
        }
    }

    public function register(){
        //user create
        $fullname = $_POST['fullname'] ?? '';
        $username = $_POST['username'] ?? '';
        $email = $_POST['email'] ?? '';
        $phoneNumber = $_POST['phone_number'] ?? '';
        $password = $_POST['password'] ?? '';
        $gender = $_POST['gender'] ?? '';
        $agree = isset($_POST['agree']) ? 1 : 0;
        
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        $rawQuery = "INSERT INTO users (fullname, username, email, phone_number, password, gender, agreed_to_terms)
                        VALUES (?, ?, ?, ?, ?, ?, ?)";
        $executionQuery = $this->connection->prepare($rawQuery);
        $executionQuery->bind_param('ssssssi',  $fullname, $username, $email,$phoneNumber,$passwordHash, $gender, $agree);
        //user create end

        //created user role assigned
        if ($executionQuery->execute()) {
            $user_id = $this->connection->insert_id;

            $roleRawQuery = "SELECT id FROM roles WHERE name = 'User' LIMIT 1;";
            $roleData = $this->connection->query($roleRawQuery);

            if ($roleData->num_rows > 0) {
                $roleRow = $roleData->fetch_assoc();
                $role_id = $roleRow['id'];

                $user_role_raw_query = 'INSERT INTO user_roles (user_id, role_id) VALUES(?, ?)';
                $user_role_execution_query = $this->connection->prepare($user_role_raw_query);

                $user_role_execution_query->bind_param('ii', $user_id, $role_id);
                $user_role_execution_query->execute();

                header('Location: /collab-training/login.php');
                exit;
            } else {
                echo "User Role not found.";
            }
        }
        //created user role assigned END
    }

    public function logout(){
        $_SESSION = [];
        unset($_SESSION['user']);
    
        session_destroy();
    
        header("Location: /collab-training/login.php");
        exit;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_GET['action'] ?? 'login';

    $controller = new AuthController;

    switch ($action) {
        case 'login':
            $controller->login();
            break;
        case 'register':
            $controller->register();
            break;
        
        default:
            $controller->login();
            break;
    }
}
?>
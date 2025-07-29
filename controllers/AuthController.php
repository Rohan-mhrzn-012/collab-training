<?php 
include_once __DIR__ . "/../database/db.php";

class AuthController {
    private $connection;

    public function __construct()
    {
        $db = new Database;
        $this->connection = $db->getConnection();
    }

    public function login($email, $password){
        session_start();
        if (empty($email) || empty($password)) {
            return ['success'=> false, "message" => "Email or password is required."];
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
                return ['success'=> true, "message" => "Logged in successfully."];
            }   else {
                return ['success'=> false, "message" => "Invalid Username Or Password."];
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

    public function edit(){
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $loggedInUser = $_SESSION['user'] ?? null;

        // check if user is signed-in
        if ($loggedInUser === null) {
            header("Location: /collab-training/login.php");
            exit;
        }
        // check if user is signed-in end

        $userid = $_GET['id'] ?? "";

        $query = "SELECT * FROM users WHERE id = ?";
        $prepareStatement = $this->connection->prepare($query);
        if (!$prepareStatement) {
            die("Prepare failed: " . $this->connection->error);
        }
        $prepareStatement->bind_param('i', $userid);
        $prepareStatement->execute();

        $result = $prepareStatement->get_result();
        $user = $result->fetch_assoc();

        // if ($result && $result->num_rows === 1 && $_SERVER['REQUEST_METHOD'] === 'GET' ) {
        //     $name = isset($_GET["fullname"]) && !empty(trim($_GET["fullname"])) ? trim($_GET["fullname"]) : $user['fullname'];
        //     $uname = $_GET["username"];
        //     $email = $_GET["email"];
        //     $pno = $_GET["phone_number"];
        //     $gen = $_GET["gender"];

        //     $updateuser = "UPDATE users SET fullname = ?, username = ?, email =?, gender = ?, phone_number = ? WHERE id = ?";
        //     $stmt = $connection->prepare($updateuser);
        //     if ($stmt === null) {
        //         die("Connection error" . $connection->error);
        //     }
        //     $stmt->bind_param("sssssi", $name, $uname, $email, $gen, $pno, $userid);
        //     $stmt->execute();
        // }

        if ($result && $result->num_rows === 1 && $_SERVER['REQUEST_METHOD'] === 'GET') {
            $name  = !empty($_GET['fullname']) ? $_GET['fullname'] : $user['fullname'];
            $uname = !empty($_GET['username']) ? $_GET['username'] : $user['username'];
            $email = !empty($_GET['email']) ? $_GET['email'] : $user['email'];
            $pno   = !empty($_GET['phone_number']) ? $_GET['phone_number'] : $user['phone_number'];
            $gen   = !empty($_GET['gender']) ? $_GET['gender'] : $user['gender'];
            $submit = $_GET['submit'] ?? "";


            $updateuser = "UPDATE users SET fullname = ?, username = ?, email = ?, gender = ?, phone_number = ? WHERE id = ?";
            $stmt = $this->connection->prepare($updateuser);
            if (!$stmt) {
                die("Prepare failed: " . $this->connection->error);
            }

            $stmt->bind_param("sssssi", $name, $uname, $email, $gen, $pno, $userid);

            $stmt->execute();

            if ($submit === "submit") {
                if ($stmt->affected_rows > 0) {
                    echo "User updated successfully!";
                } else {
                    echo "No user updated";
                }
            }
            $stmt->close();
        }
    }
}
?>
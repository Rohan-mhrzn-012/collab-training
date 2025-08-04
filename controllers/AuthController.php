<?php
include_once __DIR__ . "/../database/db.php";
if(session_status()== PHP_SESSION_NONE) {
    session_start();
}
class AuthController
{
    private $connection;

    public function __construct()
    {
        $db = new Database;
        $this->connection = $db->getConnection();
    }

    public function login()
    {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        if (empty($email) || empty($password)) {
            $_SESSION['error'] = 'Email or password is required.';
            header('Location: /collab-training/login.php');
            exit;
        }

        $query = "SELECT users.password, users.id, users.fullname, users.pimage AS profile_image, users.username, users.email, users.phone_number, 
        GROUP_CONCAT(roles.name) as user_role FROM users left JOIN user_roles ON user_roles.user_id = users.id left join roles 
        on user_roles.role_id = roles.id WHERE email = ?";

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
                    "user_roles" => explode(",", $user['user_role']),
                    "profimage" => $user['profile_image']
                ];
                header('Location: /collab-training/index.php?page=dashboard');
                exit;
            }
        } else {
            header('Location: /collab-training/login.php');
        }
    }



    public function register()
    {
        //user create
        $fullname = $_POST['fullname'] ?? '';
        $username = $_POST['username'] ?? '';
        $email = $_POST['email'] ?? '';
        $phoneNumber = $_POST['phone_number'] ?? '';
        $password = $_POST['password'] ?? '';
        $gender = $_POST['gender'] ?? '';
        $agree = isset($_POST['agree']) ? 1 : 0;

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);
        //take image
        if(isset($_FILES['profile_picture'])){
            $fileTemp = $_FILES["profile_picture"]['tmp_name'];//stores the tmp 
            $fileName = basename($_FILES["profile_picture"]['name']);//hold the name of image
            $extension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));//extension of image eg .png
            
            $allowed = ["jpg","jpeg","png","gif"];

            if(in_array($extension, $allowed)){
                $newFileName = uniqid("img_", true) . "." . $extension; //add unique id infront of eg <div class="png"></div>
                $uploadDir = __DIR__ . "/../public/images/profilepic/";//full path to project for saving image
                $uploadPath = $uploadDir . $newFileName;//concat path and image name
                
                if(move_uploaded_file($fileTemp, $uploadPath)){
                    $image = "images/profilepic/" . $newFileName;//store relative path to save in db

                }else{
                    echo "Failed to move Uploaded file";
                    exit;
                }


                }else{
                    echo implode(',', $allowed);
                    exit;
                }  
            }
       
        $rawQuery = "INSERT INTO users (fullname, username, email, phone_number, password, gender, pimage, agreed_to_terms) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $executionQuery = $this->connection->prepare($rawQuery);
        $executionQuery->bind_param('sssssssi',  $fullname, $username, $email, $phoneNumber, $passwordHash, $gender, $image, $agree);
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

    public function logout()
    {
        $_SESSION = [];
        unset($_SESSION['user']);

        session_destroy();

        header("Location: /collab-training/login.php");
        exit;
    }
}



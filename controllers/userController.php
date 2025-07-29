<?php
include __DIR__. '/../database/db.php';
class UserController {
    private $connection;

    public function __construct()
    {
     $db = new Database();
     $this->connection = $db->getConnection();    
    }

    public function getAllUsers(){

    }

    public function createUser(){

    }
//updateuser start
    public function updateUser(){
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

$userid = $_POST['id'] ?? "";

$query = "SELECT * FROM users WHERE id = ?";
$prepareStatement = $this->connection->prepare($query);
if (!$prepareStatement) {
    die("Prepare failed: " . $this->connection->error);
}
$prepareStatement->bind_param('i', $userid);
$prepareStatement->execute();

$result = $prepareStatement->get_result();
$user = $result->fetch_assoc();



if ($result && $result->num_rows === 1 && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $name  = !empty($_POST['fullname']) ? $_POST['fullname'] : $user['fullname'];
    $uname = !empty($_POST['username']) ? $_POST['username'] : $user['username'];
    $email = !empty($_POST['email']) ? $_POST['email'] : $user['email'];
    $pno   = !empty($_POST['phone_number']) ? $_POST['phone_number'] : $user['phone_number'];
    $gen   = !empty($_POST['gender']) ? $_POST['gender'] : $user['gender'];
    $submit = $_POST['submit'] ?? "";


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
//updateuser end

//delete user start
    public function delete(){

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);
     $userid = intval($_SESSION['user']['id'] ?? 0);
 
    
    if ($userid == $id) {
        echo "You can't delete yourself";
        exit;
    } else {
    $stmt = $this->connection->prepare("DELETE FROM users WHERE id = ?");
    if (!$stmt) {
        echo "SQL error: " . $this->connection->error;
        exit;
    }

    $stmt->bind_param("i", $id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "User ID $id deleted successfully.";
    } else {
        echo "No user found with ID $id.";
    }
    }
    $stmt->close();
} else {
    echo "Invalid request.";
}

    }
    //delete user end
}

if($_SERVER['REQUEST_METHOD'] === "POST"){
    $action = $_GET["action"] ?? null;
    
    $controller = new UserController;

    if($action !== null){
        switch($action){
            case 'edit':
                $controller->updateUser();
                break;
            case 'delete':
                $controller->delete();
                break;
            }

    }
}
<?php
require_once __DIR__ . '/../database/db.php';
class UserController
{
    private $connection;

    public function __construct()
    {
        $db = new Database();
        $this->connection = $db->getConnection();
    }

    public function getAllUsers($id)
    {
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

        $userid = $id;

        $query = "SELECT * FROM users WHERE id = ?";
        $prepareStatement = $this->connection->prepare($query);
        if (!$prepareStatement) {
            die("Prepare failed: " . $this->connection->error);
        }
        $prepareStatement->bind_param('i', $userid);
        $prepareStatement->execute();

        $result = $prepareStatement->get_result();
        return $result->fetch_assoc();
    }

    public function createUser() {}
    //updateuser star
    public function updateUser()
    {
        $userid = $_POST['id'];
       

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
             $user = $this->getAllUsers($userid);
            // Get form data or fallback to existing user data
            $name  = !empty($_POST['fullname']) ? $_POST['fullname'] : $user['fullname'];
            $uname = !empty($_POST['username']) ? $_POST['username'] : $user['username'];
            $email = !empty($_POST['email']) ? $_POST['email'] : $user['email'];
            $pno   = !empty($_POST['phone_number']) ? $_POST['phone_number'] : $user['phone_number'];
            $gen   = !empty($_POST['gender']) ? $_POST['gender'] : $user['gender'];

            // Default to the existing image if no new image is uploaded
            $image = $user['pimage'];  // This keeps the current image if no new one is uploaded

            // Handle new image upload
            if (isset($_FILES['profileimage']) && $_FILES['profileimage']['error'] === 0) {
                $fileTemp = $_FILES['profileimage']['tmp_name'];
                $imgName = basename($_FILES['profileimage']['name']);
                $extension = strtolower(pathinfo($imgName, PATHINFO_EXTENSION));

                $newImgName = uniqid('uprofile_', true) . "." . $extension;
                $uploadDir = __DIR__ . "/../public/images/profilepic/";
                $uploadPath = $uploadDir . $newImgName;

                // Attempt to upload the new file
                if (move_uploaded_file($fileTemp, $uploadPath)) {

                    $oldImagePath = __DIR__ . '/../public/images/profilepic/' . $user['pimage'];
                    if (!empty($user['pimage']) && file_exists($oldImagePath)) {
                        unlink($oldImagePath);
                    }
                    // If successful, update the image path
                    $image = $newImgName;
                } else {
                    $_SESSION['message'] = "Failed to upload image.";
                    header("Location: /collab-training/index.php?page=users");
                    exit;
                }
            }

            // SQL query to update user data including the image
            $updateuser = "UPDATE users SET fullname = ?, username = ?, email = ?, phone_number = ?, gender = ?, pimage = ? WHERE id = ?";
            $stmt = $this->connection->prepare($updateuser);

            if (!$stmt) {
                die("Prepare failed: " . $this->connection->error);
            }

            // Bind parameters and execute the query
            $stmt->bind_param("ssssssi", $name, $uname, $email, $pno, $gen, $image, $userid);
            $stmt->execute();

            // Check if any rows were affected
            if ($stmt->affected_rows > 0) {
                $_SESSION['message'] = "User updated successfully!";
            } else {
                $_SESSION['message'] = "No changes were made.";
            }

            // Redirect after the update
            header("Location: /collab-training/index.php?page=users");
            exit;

            $stmt->close();
        }
    }


    //updateuser end

    //delete user start
    public function delete()
    {
        header('Content-Type: application/json');

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            $id = intval($_POST['id']);
            $userid = $_SESSION['user']['id'] ?? 0;

            // Check if user tries to delete themselves
            if ($userid === $id) {
                echo json_encode(['status' => 'error', 'message' => "You can't delete yourself"]);
                exit;
            }

            // Prepare and execute delete query
            $stmt = $this->connection->prepare("DELETE FROM users WHERE id = ?");
            if (!$stmt) {
                echo json_encode(['status' => 'error', 'message' => "SQL error: " . $this->connection->error]);
                exit;
            }

            $stmt->bind_param("i", $id);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                echo json_encode(['status' => 'success', 'message' => "User ID $id deleted successfully."]);
            } else {
                echo json_encode(['status' => 'error', 'message' => "No user found with ID $id."]);
            }

            $stmt->close();
            exit;
        } else {
            echo json_encode(['status' => 'error', 'message' => "Invalid request."]);
            exit;
        }
    }

    //delete user end
}

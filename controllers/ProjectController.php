<?php require_once __DIR__ . "/../database/db.php";

class ProjectController
{
    private $connection;

    public function __construct()
    {
        $db = new Database;
        $this->connection = $db->getConnection();
    }
    public function getAllProjects()
    {
        $raw_query = "SELECT * FROM projects";
        $query = $this->connection->query($raw_query);
        // if($query){
        return $query->fetch_all(MYSQLI_ASSOC);
        // }
        // return [];        
    }

    public function index()
    {
        $query = "SELECT projects.*,users.fullname FROM projects 
            INNER JOIN users on projects.user_id=users.id";
        $result = $this->connection->query($query);

        $projects = [];
        if ($result) {
            $projects = $result->fetch_all(MYSQLI_ASSOC);
        }
        // return $projects;

        return [
            "project_data" => $projects,

        ];
    }

    public function create()
    {
       
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            //getting user id on the basis of the username selected
            $username = $_POST["username"];
            $id_query = "SELECT * from users where username=?";
            $prepare_statement = $this->connection->prepare($id_query);
            $prepare_statement->bind_param("s", $username);
            $prepare_statement->execute();
            $id = $prepare_statement->get_result();
            $row = $id->fetch_assoc();
            if (!$row) {
                $error = "Selected user not found.";
                include "./view/projects/create.php";
                return;
            }
            $user_id = $row["id"];

            //getting image from create form and giving it temporary name and storing it in the system
            //name is stored in database but file is temporarily saved in the system

            $project_image = null;
            if (isset($_FILES["project_image"])) {
                //accessing the temporary path
                $tempName = $_FILES["project_image"]["tmp_name"];
                //getting the actual location

                $originalName = basename($_FILES["project_image"]["name"]); //basename prevents directory traversal attacks
                //accessing the file extension like jpg, png
                $extension = pathinfo($originalName, PATHINFO_EXTENSION);
                //giving unique name to the image
                $project_image = uniqid("project_", true) . "." . $extension;

                //copying to public/uploads/project_images
                $destination = __DIR__ . "/../public/uploads/project_images/" . $project_image;
                //now the project image will be in our system
                move_uploaded_file($tempName, $destination);
            }

            $project_name = $_POST["project_name"];

            if (empty($project_name)) {
                // $error = "The project name is empty";
                // include "./view/projects/create.php";

                $_SESSION['error']="The project name is empty";

                header("Location:/core_php/collab-training/index.php?page=create_project");
                exit;
            }
            $project_description = $_POST["project_description"];
            $start_date = $_POST["start_date"];
            $end_date = $_POST["end_date"];
            $status = $_POST["status"];
            $query = "INSERT into projects (project_name, description, start_date, end_date,status,user_id,project_image) values(?,?,?,?,?,?,?)";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("sssssis", $project_name, $project_description, $start_date, $end_date, $status, $user_id, $project_image);

            if ($stmt->execute()) {
                header("Location:/core_php/collab-training/index.php?page=projects");
            } else {
                echo "Error";
            }


            exit();
        }
    }

    public function edit()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_GET["id"])) {
            $project_id = $_GET["id"];
            //updating in the database
            $project_name = $_POST["project_name"];
            $project_description = $_POST["project_description"];
            $start_date = $_POST["start_date"];
            $end_date = $_POST["end_date"];
            $status = $_POST["status"];
            //Delete the old photo on the basis of the old photo name
            //do query to get old image name from database on the basis of the id
            $old_img=
            $project_image = [];
            if (isset($_FILES["project_image"])) {
                $tempName = $_FILES["project_image"]["tmp_name"];
                $originalName = basename($_FILES["project_image"]["name"]);
                $extension = pathinfo($originalName, PATHINFO_EXTENSION);
                $project_image = uniqid("project_", true) . "." . $extension;

                $destination = __DIR__ . "/../public/uploads/project_images/" . $project_image;
                move_uploaded_file($tempName, $destination);
            }


            // unlink();
            $query = "UPDATE projects SET project_name=?, description=?,start_date=?,end_date=?, status=?, project_image=? where project_id=?";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("ssssssi", $project_name, $project_description, $start_date, $end_date, $status, $project_image, $project_id);
            $stmt->execute();
            header("Location:/core_php/collab-training/index.php?page=edit_project&id=" . $project_id);
            exit();
        }
    }

    public function view()
    {
        $project_id = $_GET["id"];
        $query = "SELECT * from projects where project_id=?";
        $prepare_stmt = $this->connection->prepare($query);
        $prepare_stmt->bind_param("i", $project_id);
        $prepare_stmt->execute();
        $result = $prepare_stmt->get_result();
        $view_data = $result->fetch_assoc();

        return $view_data;

        // header("Location: /core_php/collab_training/view/projects/view.php?page=view_project");
    }

    public function delete()
    {
        // $project_id = $_GET["project_id"];

        $project_id = $_POST["project_id"];

        $query = "DELETE from projects where project_id=?";
        $prepare_statement = $this->connection->prepare($query);
        $prepare_statement->bind_param("i", $project_id);

        if ($prepare_statement->execute()) {
            echo json_encode(["status" => "success"]);
        } else {
            echo json_encode(["status" => "failed", "message" => "Delete failed"]);
        }

        // header("Location:/core_php/collab-training/index.php?page=delete_project");
        // exit();
    }
}



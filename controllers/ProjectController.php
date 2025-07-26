<?php include __DIR__ . "/../database/db.php";

class ProjectController
{
    private $connection;

    public function __construct()
    {
        $db = new Database;
        $this->connection = $db->getConnection();
    }

    public function index()
    {
        $query = "SELECT * FROM projects";
        $result = $this->connection->query($query);

        $projects = [];
        if ($result) {
            $projects = $result->fetch_all(MYSQLI_ASSOC);
        }
        // return $projects;

        $join_query = "SELECT project_id, project_name, fullname 
                        FROM projects
                        INNER JOIN users ON projects.user_id = users.id;";
        $join_result=$this->connection->query($join_query);
        $join_data=[];
        if($join_result){
            $join_data=$join_result->fetch_all(MYSQLI_ASSOC);
        }
        // return $join_data;
        return["project_data"=> $projects,
            "join_data"=>$join_data,
        ];    
    }

    public function create()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $project_name = $_POST["project_name"];
            $project_description = $_POST["project_description"];
            $start_date = $_POST["start_date"];
            $end_date = $_POST["end_date"];
            $status = $_POST["status"];
            $query = "INSERT into projects (project_name, description, start_date, end_date,status) values(?,?,?,?,?)";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("sssss", $project_name, $project_description, $start_date, $end_date, $status);
            $stmt->execute();
            header("Location:/core_php/collab-training/index.php?page=projects");
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
            $query = "UPDATE projects SET project_name=?, description=?,start_date=?,end_date=?, status=? where project_id=?";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("sssssi", $project_name, $project_description, $start_date, $end_date, $status, $project_id);
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
        $project_id = $_GET["project_id"];
        $query = "DELETE from projects where project_id=?";
        $prepare_statement = $this->connection->prepare($query);
        $prepare_statement->bind_param("i", $project_id);
        $prepare_statement->execute();

        header("Location:/core_php/collab-training/index.php?page=delete_project");
        exit();
    }
}


$project_obj = new ProjectController;


$action = $_GET["action"] ?? null;
switch ($action) {
    case "create":
        $project_obj->create();
        break;
    case "view":
        $project_obj->view();
        break;
    case "edit":
        $project_obj->edit();
        break;
    case "delete":
        $project_obj->delete();
        break;
}

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
        return $projects;
    }

    public function edit() {}

    public function view()
    {
        $project_id=$_GET["id"];
        $query = "SELECT * from projects where project_id=?";
        $prepare_stmt = $this->connection->prepare($query);
        $prepare_stmt->bind_param("i", $project_id);
        $prepare_stmt->execute();
        $result = $prepare_stmt->get_result();
        $view_data = $result->fetch_assoc();

        return $view_data;

        header("Location: /core_php/collab_training/view/projects/view.php?page=view_project");
    }

    public function delete() {}
}

$page = $_GET["page"];
$project_obj = new ProjectController;

if ($page === "projects") {
    $action = $_GET["action"] ?? null;
    switch ($action) {
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
}

<?php
include_once __DIR__ . "/../database/db.php";

class SkillController
{
    private $connection;

    public function __construct()
    {
        $db = new Database;
        $this->connection = $db->getConnection();
    }

    public function getAllSkills()
    {
        $query = "Select * from skills";
        $result = $this->connection->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function index()
    {
        $query = "SELECT skills.*,users.fullname from skills INNER JOIN users on skills.user_id=users.id;";
        $result = $this->connection->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function create()
    {

        $name = $_POST["skill_name"];
        $category = $_POST["skill_category"];
        $level = $_POST["skill_level"];
        $created = $_POST["created_at"];
        $updated = $_POST["updated_at"];
        $username = $_POST["username"] ?? null;

        $user_query = "SELECT id from users where username=?";
        $user_stmt = $this->connection->prepare($user_query);
        $user_stmt->bind_param("s", $username);
        $user_stmt->execute();
        $user_result = $user_stmt->get_result();
        $user_id = $user_result->fetch_assoc()["id"];

        $query = "INSERT into skills (skill_name,skill_category,skill_level,created_at,updated_at,user_id) values(?,?,?,?,?,?)";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("sssssi", $name, $category, $level, $created, $updated,$user_id);
        if ($stmt->execute()) {
            header("Location:/core_php/collab-training/index.php?page=skills");
        } else {
            echo "error";
        }
    }

    public function view()
    {
        $id = $_GET["id"] ?? null;
        $query = "SELECT skills.*,users.* FROM skills INNER JOIN users on skills.user_id=users.id WHERE skills.id = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function edit()
    {
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_GET["id"])) {
            $id = $_GET["id"];
            $name = $_POST["skill_name"];
            $category = $_POST["skill_category"];
            $level = $_POST["skill_level"];
            $created = $_POST["created_at"];
            $updated = $_POST["updated_at"];
            $username = $_POST["username"];
            $query = "UPDATE skills INNER JOIN users on skills.user_id=users.id set skills.skill_name=?, skills.skill_category=?, skills.skill_level=?,skills.created_at=?,skills.updated_at=?,users.username=? where skills.id=?";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("ssssssi", $name, $category, $level, $created, $updated, $username, $id);
            $stmt->execute();


            header("Location:/core_php/collab-training/index.php?page=skills&id=" . $id);
        }
    }

    public function delete()
    {
        $skill_id = $_POST["skill_id"];
        $query = "DELETE from skills where id=?";
        $prepare_statement = $this->connection->prepare($query);
        $prepare_statement->bind_param("i", $skill_id);

        if ($prepare_statement->execute()) {
            echo json_encode(["status" => "success"]);
        } else {
            echo json_encode(["status" => "failed", "message" => "Delete failed"]);
        }
    }
}

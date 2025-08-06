<?php
include_once __DIR__ . "/../database/db.php";

class ExperienceController
{
    private $connection;
    public function __construct()
    {
        $db = new Database();
        $this->connection = $db->getConnection();
    }

    public function getAllExperience()
    {
        $query = "Select * from experience";
        $result = $this->connection->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function index()
    {
        $query = "SELECT experience.*, users.fullname, experience.title, experience.organization, experience.location, experience.start_date, experience.end_date
        FROM experience
        INNER JOIN users ON experience.user_id = users.id;";
        $result = $this->connection->query($query);
        if ($result) {
            return $result->fetch_all(MYSQLI_ASSOC);
        }
    }

     public function view()
    {
        $id = $_GET["id"] ?? null;
        // $query = "SELECT * FROM experience WHERE id = ?";

        $query = "SELECT experience.*, users.fullname,users.username 
              FROM experience 
              INNER JOIN users ON experience.user_id = users.id 
              WHERE experience.id = ?";
        $stmt = $this->connection->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function create(){
        if($_SERVER["REQUEST_METHOD"]==="POST"){
            $title = $_POST["title"] ?? null;
            $organization = $_POST["organization"] ?? null;
            $location = $_POST["location"] ?? null;
            $description = $_POST["description"] ?? null;
            $start_date = $_POST["start_date"] ?? null;
            $end_date = $_POST["end_date"] ?? null;
            $username = $_POST["username"] ?? null;

            $user_query="SELECT id from users where username=?";
            $user_stmt=$this->connection->prepare($user_query);
            $user_stmt->bind_param("s", $username);
            $user_stmt->execute();
            $user_result=$user_stmt->get_result();
            $user_id=$user_result->fetch_assoc()["id"];

            $query="INSERT into experience (title,organization,location,description,start_date,end_date,user_id) values(?,?,?,?,?,?,?)";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("ssssssi", $title, $organization, $location,$description,$start_date,$end_date,$user_id);
            
            
            if($stmt->execute()){
                header("Location:/core_php/collab-training/index.php?page=experience");
            }
            $stmt->close();
            $user_stmt->close();
            
        }
        
    }

    public function edit(){
        if($_SERVER["REQUEST_METHOD"]==="POST" && isset($_GET["id"])){
            $id = $_GET["id"] ?? null;
            $title=$_POST["title"]??null;
            $organization=$_POST["organization"]??null;
            $location=$_POST["location"]??null;
            $description=$_POST["description"]??null;
            $start_date=$_POST["start_date"]??null;
            $end_date=$_POST["end_date"]??null;
            $username=$_POST["username"];

            $query="UPDATE  experience INNER JOIN users on experience.user_id=users.id set experience.title=?, experience.organization=?,experience.location=?,experience.description=?,experience.start_date=?,experience.end_date=?,users.username=?  where experience.id=?";
            $stmt=$this->connection->prepare($query);
            $stmt->bind_param("sssssssi",$title,$organization,$location,$experience,$start_date,$end_date,$username,$id);
            
            if($stmt->execute()){
                header("Location:/core_php/collab-training/index.php?page=experience");
                echo("Updated ".$username."'s info successfully");
            }
            $stmt->close();


        }

    }

    public function delete()
    {
        $exp_id = $_POST["exp_id"];
        $query = "DELETE from experience where id=?";
        $prepare_statement = $this->connection->prepare($query);
        $prepare_statement->bind_param("i", $exp_id);
        $_SESSION["success"] = "Experience deleted successfully!";
        if ($prepare_statement->execute()) {
            echo json_encode(["status" => "success"]);
        } else {
            echo json_encode(["status" => "failed", "message" => "Delete failed"]);
        }
    }
}

<?php
    include_once __DIR__ . "/../database/db.php";
    
    class SkillController{
        private $connection;

        public function __construct()
        {
            $db = new Database;
            $this->connection =$db->getConnection();
        }

        public function getAllSkills(){
            $query ="Select * from skills";
            $result=$this->connection->query($query);
            return $result->fetch_all(MYSQLI_ASSOC);
        }

        public function create(){

        }

        public function view(){
            $id=$_GET["id"]??null;
            $query = "SELECT * FROM skills WHERE id = ?";
            $stmt = $this->connection->prepare($query);
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $result = $stmt->get_result();
            return $result->fetch_assoc();
        }

        public function edit(){
            if($_SERVER["REQUEST_METHOD"]==="POST" && isset($_GET["id"])){
                $id=$_GET["id"];
                $name=$_POST["skill_name"];
                $category=$_POST["skill_category"];
                $level=$_POST["skill_level"];
                $created=$_POST["created_at"];
                $updated=$_POST["updated_at"];
                $query="UPDATE skills set skill_name=?, skill_category=?,skill_level=?,created_at=?,updated_at=? where id=?";
                $stmt=$this->connection->prepare($query);
                $stmt->bind_param("sssssi",$name,$category,$level,$created,$updated,$id);
                $stmt->execute();
                
                
                header("Location:/core_php/collab-training/index.php?page=edit-skill&id=".$id);


            }

        }

        public function delete(){

        }
    }
?>
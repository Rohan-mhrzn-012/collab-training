<?php

class UserController {
    private $connection;
    public function __construct()
    {
        $db= new Database;
        $this->connection = $db->getConnection();
    }

    public function getAllUsers(){
        $raw_query="SELECT * FROM users";
        $query=$this->connection->query($raw_query);
        if($query){
            return $query->fetch_all(MYSQLI_ASSOC);
        }
        return [];
        // $result=$query->fetch_all(MYSQLI_ASSOC);
        // return $result;
    }

    public function createUser(){

    }

    public function updateUser(){

    }

    public function delete(){

    }
}
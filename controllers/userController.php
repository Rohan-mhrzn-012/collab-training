<?php

class UserController {
    public function __construct()
    {
        
    }

    public function getAllUsers(){

    }

    public function createUser(){

    }

    public function updateUser(){

    }

    public function delete(){
        header("Content-Type: application/json");
        echo json_encode(["success"=> true, "message"=> "message ho yo"]);
    }
}
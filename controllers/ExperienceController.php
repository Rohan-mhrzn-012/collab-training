<?php
    include_once __DIR__ ."/../database/db.php";

    class ExperienceController{
        private $connection;
        public function __construct(){
            $db= new Database();
            $this->connection = $db->getConnection();
        }
    }
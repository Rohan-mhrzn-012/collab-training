<?php

    include_once __DIR__ . "/../bootstrap.php";

    class Database {
        private $host;
        private $user;
        private $password;    
        private $db;
        private $port;
        private $connection;

        public function __construct()
        {
            $this->host = $_ENV['DB_HOST'] ?? 'localhost';
            $this->user = $_ENV['DB_USER'] ?? 'root';
            $this->password = $_ENV['DB_PASSWORD'] ?? '';
            $this->db = $_ENV['DB_NAME'] ?? 'test';
            $this->port = $_ENV['DB_PORT'] ?? '3306';

            $this->connection = new mysqli($this->host, $this->user, $this->password, $this->db, $this->port);
            if ($this->connection->connect_error) {
                die("Connection Failed: ". $this->connection->connect_error);
            }

        }

        public function getConnection(){
            return $this->connection;
        }

    }

?>

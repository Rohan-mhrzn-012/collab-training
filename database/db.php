<?php
    class Database {
        private $host = 'localhost';
        private $user = 'root';
        private $password = '';
        private $db = 'test';
        private $port = 3310;
        private $connection;

        public function __construct()
        {
            $this->connection = new mysqli($this->host, $this->user, $this->password, $this->db);
            if ($this->connection->connect_error) {
                die("Connection Failed: ". $this->connection->connect_error);
            }

        }

        public function getConnection(){
            return $this->connection;
        }

    }

?>


<?php
    $host = 'localhost';
    $user = 'root';
    $password = '';
    $db = 'test';
    $port = 3310;

    $connection = new mysqli($host, $user, $password, $db);
    if ($connection->connect_error) {
        die("connection fail:" . $connection->connect_error);
    }
?>
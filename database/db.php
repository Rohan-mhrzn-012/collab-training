<?php
    require_once __DIR__ . '/../vendor/autoload.php';

    use Dotenv\Dotenv;

    // Create Dotenv instance and load .env values

    $dotenv = Dotenv::createImmutable(dirname(__DIR__));
    $dotenv->load();
class Database
{
    private $host;
    private $user;
    private $password;
    private $db;
    // private $port = 3310;
    private $connection;

    public function __construct()
    {
        $this->host = $_ENV["DB_HOST"];
        $this->user = $_ENV["DB_USER"];
        $this->password = $_ENV["DB_PASSWORD"];
        $this->db = $_ENV["DB_NAME"];
        $this->connection = new mysqli($this->host, $this->user, $this->password, $this->db);
        if ($this->connection->connect_error) {
            die("Connection Failed: " . $this->connection->connect_error);
        }
    }

    public function getConnection()
    {
        return $this->connection;
    }
}

<?php

namespace Utils;

use PDO;
use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__."/../../");
$dotenv->load();

class Database {
    private $pdo;
    private $host;
    private $dbname;
    private $username;
    private $password;

    /**
     * Constructs a new Database instance and initializes the PDO connection.
     * 
     * This constructor retrieves database connection parameters from the environment
     * variables and uses them to establish a connection to the MySQL database.
     */
    public function __construct() {
        $this->host = $_ENV["db_host"];
        $this->dbname = $_ENV["db_name"];
        $this->username = $_ENV["db_username"]; 
        $this->password = $_ENV["db_password"];
        
        $this->pdo = new PDO(
            "mysql:host=$this->host;dbname=$this->dbname",
            $this->username,
            $this->password);
        
    }
    
    /**
     * Returns the PDO object for the database connection
     *
     * @return \PDO
     */
    public function connection() {
        return $this->pdo;
    }
}
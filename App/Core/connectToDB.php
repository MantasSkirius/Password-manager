<?php
namespace App\Core;
use PDO;
class connectToDB {
    private $conn;
    public function __construct() {
        include __DIR__."/DBconfig.php"; 
				$this->conn = new PDO("mysql:host=$address;dbname=$database", $user, $pass);
				$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function getConnection() {
        return $this->conn;
    }
}
?>
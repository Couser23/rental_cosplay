<?php
class Database {
    private $host = "localhost";
    private $db_name = "cosplay_rental";
    private $username = "root"; // Sesuaikan dengan user XAMPP/server
    private $password = "";     // Sesuaikan dengan password database
    public $conn;

    public function connect() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
?>
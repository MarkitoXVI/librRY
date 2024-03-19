<?php
class DBConnection {
    private $host = 'localhost';
    private $dbname = 'your_database_name';
    private $username = 'your_username';
    private $password = 'your_password';
    protected $pdo;

    public function __construct() {
        try {
            $this->pdo = new PDO("mysql:host=$this->host;dbname=$this->dbname", $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Error: Could not connect. " . $e->getMessage());
        }
    }
}
?>

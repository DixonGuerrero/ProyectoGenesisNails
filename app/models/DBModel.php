<?php
// DatabaseModel.php
require_once '../config/config.php';

class DatabaseModel {
    private static $instance;
    private $conn;

    private function __construct() {
        $this->connect();
    }

    private function connect() {
        $host = DB_HOST;
        $user = DB_USER;
        $pass = DB_PASS;
        $name = DB_NAME;

        $this->conn = new mysqli($host, $user, $pass, $name);

        if ($this->conn->connect_error) {
            die("Error de conexión: " . $this->conn->connect_error);
        }
    }

    public static function getInstance() {
        if (self::$instance === null) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function getConnection() {
        return $this->conn;
    }
}
?>

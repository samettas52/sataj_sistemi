<?php
session_start();

class Database {
    private static $instance = null;
    private $conn;

    private function __construct() {
        $this->conn = new mysqli("localhost", "root", "", "staj_sistemi");
        if ($this->conn->connect_error) { die("Bağlantı hatası"); }
        $this->conn->set_charset("utf8");
    }

    public static function getInstance() {
        if (!self::$instance) { self::$instance = new Database(); }
        return self::$instance->conn;
    }
}

function dbConnect() { return Database::getInstance(); }
function redirect($url) { header("Location: $url"); exit(); }
function isLoggedIn() { return isset($_SESSION['user_id']); }

function validateInput($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}
?>
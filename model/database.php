<?php
require_once 'config.php';

class Database {
    private static $db;
    private $Conn;

    private function __construct() {
        try {
            $this->Conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME, DB_USER, DB_PASS);
            $this->Conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            exit(); // Terminate script execution
        }
    }

    public static function getDb() {
        if (!self::$db) {
            self::$db = new Database();
        }
        return self::$db;
    }

    public function getConn() {
        return $this->Conn;
    }
}
?>

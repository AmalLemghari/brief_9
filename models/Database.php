<?php
class Database {
    private static $instance;
    private $host;
    private $username;
    private $password;
    private $database;
    private $connection;

    private function __construct($host, $username, $password, $database) {
        $this->host = $host;
        $this->username = $username;
        $this->password = $password;
        $this->database = $database;
    }

    public static function getInstance() {
        if (!self::$instance) {
            self::$instance = new self("localhost", "root", "", "gestionnaire");
        }
        return self::$instance;
    }

    public function connect() {
        try {
            $this->connection = new PDO("mysql:host={$this->host};dbname={$this->database}", $this->username, $this->password);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->connection;
        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }

    public function disconnect() {
        $this->connection = null;
    }
}
?>

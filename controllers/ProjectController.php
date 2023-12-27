<?php
require_once '../models/Database.php';

class Project
{
    private static $connection;

    private function __construct()
    {
        // Private constructor to prevent creating instances
    }

    public static function getConnection()
    {
        // Check if a connection has already been established
        if (!self::$connection) {
            $db = Database::getInstance(); // Assuming you have a getInstance method in your Database class
            $connection = $db->connect();

            // Check connection
            if (!$connection) {
                die('Connection failed');
            }

            // Set the connection
            self::$connection = $connection;
        }

        return self::$connection;
    }
}
?>

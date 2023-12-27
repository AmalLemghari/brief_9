<?php
require_once '../Gestionnaire/models/Database.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize input data (you might want to use a more robust method depending on your needs)
    $taskName = sanitizeInput($_POST['task_name']);
    $deadline = sanitizeInput($_POST['deadline']);
    $status = sanitizeInput($_POST['status']);

    // Create an instance of the Database class
    $db = Database::getInstance();
    $conn = $db->connect();

    // Insert the task into the database
    $sql = "INSERT INTO tasks (task_name, deadline, status) VALUES (:task_name, :deadline, :status)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':task_name', $taskName);
    $stmt->bindParam(':deadline', $deadline);
    $stmt->bindParam(':status', $status);

    if ($stmt->execute()) {
        echo "Task added successfully!";
    } else {
        echo "Error adding task: " . $stmt->errorInfo()[2];
    }

    // Close the database connection
    $db->disconnect();
}

function sanitizeInput($input)
{
    return htmlspecialchars(strip_tags(trim($input)));
}
?>

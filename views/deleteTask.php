<?php
require_once '../models/Task.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $taskModel = new TaskModel();

    $task_id = $_POST["task_id"];
    $deleted = $taskModel->deleteTaskById($task_id);
    exit();
}
?>

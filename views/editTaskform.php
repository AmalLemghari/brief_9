<?php
require_once '../models/Database.php';

$taskId = $_GET['task_id']; 
$task = getTaskById($taskId);

function getTaskById($taskId) {
    return [
        'task_id' => $taskId,
        'task_name' => $task_name,
        'deadline' => $deadline,
        'status' => $statut
    ];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        select {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        button {
            background-color: #3490dc;
            color: #fff;
            padding: 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #2779bd;
        }
    </style>
</head>
<body>

<form method="post" action="../models/Task.php">
    <input type="hidden" name="task_id" value="<?php echo $task['task_id']; ?>">

    <label for="task_name">Task Name:</label>
    <input type="text" id="task_name" name="task_name" value="<?php echo $task['task_name']; ?>" required>

    <label for="deadline">Deadline:</label>
    <input type="date" id="deadline" name="deadline" value="<?php echo $task['deadline']; ?>" required>

    <label for="status">Status:</label>
    <select id="status" name="status" required>
        <option value="Todo" <?php echo ($task['status'] === 'Todo') ? 'selected' : ''; ?>>Todo</option>
        <option value="In progress" <?php echo ($task['status'] === 'In progress') ? 'selected' : ''; ?>>In progress</option>
        <option value="Done" <?php echo ($task['status'] === 'Done') ? 'selected' : ''; ?>>Done</option>
    </select>

    <label for="project_id">Project ID:</label>
    <input type="number" id="project_id" name="project_id" value="<?php echo $task['project_id']; ?>" required>

    <label for="user_id">User ID:</label>
    <input type="number" id="user_id" name="user_id" value="<?php echo $task['user_id']; ?>" required>

    <button type="submit">Save Changes</button>
</form>

</body>
</html>

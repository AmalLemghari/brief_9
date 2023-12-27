<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Task</title>
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

<form method="post" action="addTask.php">
    <label for="task_name">Task Name:</label>
    <input type="text" id="task_name" name="task_name" required>

    <label for="deadline">Deadline:</label>
    <input type="text" id="deadline" name="deadline" required>

    <label for="status">Status:</label>
    <select id="status" name="status" required>
        <option value="Todo">Todo</option>
        <option value="In progress">In progress</option>
        <option value="Done">Done</option>
    </select>

    <button type="submit">Add Task</button>
</form>

</body>
</html>

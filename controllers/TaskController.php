<?php
require_once 'Database.php';
require_once 'Task.php'; // Assuming you have a TaskModel class

class TaskController
{
    private $taskModel;

    public function __construct()
    {
        // Create an instance of the TaskModel class
        $this->taskModel = new TaskModel();
    }

    public function displayTasks()
    {
        // Fetch tasks from the database using the model
        $tasks = $this->taskModel->getTasks();

        // Check if there are any tasks
        if (!empty($tasks)) {
            // Output tasks
            foreach ($tasks as $task) {
                echo $this->generateTaskHTML($task);
            }
        } else {
            echo "No tasks found.";
        }
    }

    private function generateTaskHTML($task)
    {
    return '
        <ul class="bg-white shadow overflow-hidden sm:rounded-md max-w-sm mx-auto mt-16">
        <li class="border-t border-gray-200">; // Ajout de la classe de bordure
        <div class="px-4 py-5 sm:px-6">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg leading-6 font-medium text-gray-900">' . $task['task_name'] . '</h3>
                        <p class="mt-1 max-w-2xl text-sm text-gray-500">' . $task['deadline'] . '</p>
                    </div>
                    <div class="mt-4 flex items-center justify-between">
                        <p class="text-sm font-medium text-gray-500">Status: <span class="' . $this->getStatusColorClass($task['status']) . '">' . $task['status'] . '</span></p>
                        <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">Edit</a>
                    </div>
                </div>
            </li>
        </ul>';
    }


    private function getStatusColorClass($status)
    {
        switch ($status) {
            case 'Todo':
                return 'text-yellow-300';
            case 'In progress':
                return 'text-blue-300';
            case 'Done':
                return 'text-green-400';
            default:
                return 'text-gray-500';
        }
    }
}

// Example usage:
$taskController = new TaskController();
$taskController->displayTasks();
?>

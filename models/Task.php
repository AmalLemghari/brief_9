<?php
require_once __DIR__ . '/Database.php';

class TaskModel
{
    public function getTasks()
    {
        $db = Database::getInstance();
        $conn = $db->connect();

        $sql = "SELECT * FROM tasks";
        $result = $conn->query($sql);

        $tasks = [];

        if ($result->rowCount() > 0) {
            $tasks = $result->fetchAll(PDO::FETCH_ASSOC);
        }

        $db->disconnect();

        return $tasks;
    }

    public function deleteTaskById($taskId)
    {
        $db = Database::getInstance();
        $conn = $db->connect();

        try {
            $sql = "DELETE FROM tasks WHERE task_id = :task_id";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(":task_id", $taskId, PDO::PARAM_INT);
            $stmt->execute();

            $affectedRows = $stmt->rowCount();

            $db->disconnect();

            return $affectedRows > 0;
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tasks</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        ul.breadcrumb li+li::before {
        content: "\276F";
        padding-left: 8px;
        padding-right: 4px;
        color: inherit;
        }

        ul.breadcrumb li span {
            opacity: 60%;
        }

        #sidebar {
            -webkit-transition: all 300ms cubic-bezier(0, 0.77, 0.58, 1);
            transition: all 300ms cubic-bezier(0, 0.77, 0.58, 1);
        }

        #sidebar.show {
            transform: translateX(0);
        }

        #sidebar ul li a.active {
            background: #1f2937;
            background-color: #1f2937;
        }
    </style>
</head>
<body>
<nav id="navbar" class="fixed top-0 z-40 flex w-full flex-row justify-end bg-gray-700 px-4 sm:justify-between">
    <ul class="breadcrumb hidden flex-row items-center py-4 text-lg text-white sm:flex">
        <li class="inline">
            <a href="#">Main</a>
        </li>
        <li class="inline">
            <span>Tasks</span>
        </li>
    </ul>
    <button id="btnSidebarToggler" type="button" class="py-4 text-2xl text-white hover:text-gray-200">
        <svg id="navClosed" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="h-8 w-8">
            <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
        </svg>
        <svg id="navOpen" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
            stroke="currentColor" class="hidden h-8 w-8">
            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
        </svg>
    </button>
</nav>
<div id="containerSidebar" class="z-40">
    <div class="navbar-menu relative z-40">
        <nav id="sidebar"
            class="fixed left-0 bottom-0 flex w-3/4 -translate-x-full flex-col overflow-y-auto bg-gray-700 pt-6 pb-8 sm:max-w-xs lg:w-80">
            <div class="px-4 pb-6">
                <h3 class="mb-2 text-xs font-medium uppercase text-gray-500">
                    Main
                </h3>
                <ul class="mb-8 text-sm font-medium">
                    <li>
                        <a class="flex items-center rounded py-3 pl-3 pr-4 text-gray-50 hover:bg-gray-600"
                            href="../views/dashboard.php">
                            <span class="select-none">Dashboard</span>
                        </a>
                    </li>

                </ul>
            </div>

            <div class="px-4 pb-6">
                <h3 class="mb-2 text-xs font-medium uppercase text-gray-500">
                    Management
                </h3>
                <ul class="mb-8 text-sm font-medium">
                    <li>
                        <a class="flex items-center rounded py-3 pl-3 pr-4 text-gray-50 hover:bg-gray-600"
                            href="../models/Project.php">
                            <span class="select-none">Projects</span>
                        </a>
                    </li>
                    <li>
                        <a class="active flex items-center rounded py-3 pl-3 pr-4 text-gray-50 hover:bg-gray-600"
                            href="../models/Task.php">
                            <span class="select-none">Tasks</span>
                        </a>
                    </li>

                </ul>
            </div>

            <div class="px-4 pb-6">
                <h3 class="mb-2 text-xs font-medium uppercase text-gray-500">
                    Others
                </h3>
                <ul class="mb-8 text-sm font-medium">
                    <li>
                        <a class="flex items-center rounded py-3 pl-3 pr-4 text-gray-50 hover:bg-gray-600"
                            href="../views/logout.php">
                            <span class="select-none">Log Out</span>
                        </a>
                    </li>

                </ul>
            </div>
        </nav>
    </div>
    <div class="mx-auto lg:ml-80"></div>
</div>
<form class="flex items-center max-w-xl mx-auto mt-20">
        <label for="simple-search" class="sr-only">Search</label>
        <div class="relative w-full">
            <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5v10M3 5a2 2 0 1 0 0-4 2 2 0 0 0 0 4Zm0 10a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm12 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4Zm0 0V6a3 3 0 0 0-3-3H9m1.5-2-2 2 2 2"/>
                </svg>
            </div>
            <input type="text" id="simple-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Search branch name..." required>
        </div>
        <button type="submit" class="p-2.5 ms-2 text-sm font-medium text-white bg-blue-400 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
            </svg>
            <span class="sr-only">Search</span>
        </button>
</form>
<main>
<?php
$db = Database::getInstance();
$conn = $db->connect();

$sql = "SELECT * FROM tasks";
$result = $conn->query($sql);

// Check if there are any results
if ($result->rowCount() > 0) {
    // Output each row as an HTML list item
    while ($row = $result->fetch(PDO::FETCH_ASSOC)) {
        echo '<ul class="bg-white shadow overflow-hidden sm:rounded-md max-w-lg mx-auto mt-16">';
        echo '<li class="border-t border-gray-200">'; 
        echo '<div class="px-4 py-5 sm:px-6">';
        echo '<div class="flex items-center justify-between">';
        echo '<h3 class="text-lg leading-6 font-medium text-gray-900">' . $row['task_name'] . '</h3>';
        echo '<p class="mt-1 max-w-full text-md text-gray-500">' . $row['deadline'] . '</p>';
        echo '</div>';
        echo '<div class="mt-4 flex items-center justify-between">';
        echo '<p class="text-sm font-medium text-gray-500">Status: <span class="' . getStatusColorClass($row['status']) . '">' . $row['status'] . '</span></p>';
        echo '<p class="mt-1 max-w-full text-md text-gray-500">Project ID: <span class="text-blue-500 font-bold">' . $row['project_id'] . '</span></p>';
        echo '<p class="mt-1 max-w-full text-md text-gray-500">User ID: <span class="text-purple-500 font-bold">' . $row['user_id'] . '</span></p>';
        
        echo '<div class="flex space-x-2 justify-end px-4 py-2">';
        echo '<form method="post" action="../views/deleteTask.php">';
        echo '<input type="hidden" name="task_id" value="' . $row['task_id'] . '">';
        echo '<button type="submit" class="text-gray-500 transition-colors duration-200 dark:hover:text-red-500 dark:text-gray-300 hover:text-red-500 focus:outline-none">';
        echo '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">';
        echo '<path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0" />';
        echo '</svg>';
        echo '</button>';
        echo '</form>';

        echo '<form method="post" action="../views/editTaskform.php">';
        echo '<input type="hidden" name="task_id" value="' . $row['task_id'] . '">';
        echo '<button type="submit" class="text-gray-500 transition-colors duration-200 dark:hover:text-yellow-500 dark:text-gray-300 hover:text-yellow-500 focus:outline-none">';
        echo '<svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">';
        echo '<path stroke-linecap="round" stroke-linejoin="round" d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10" />';
        echo '</svg>';
        echo '</button>';
        echo '</form>';
        
        echo '</div>'; 
        echo '</div>';
        echo '</div>';
        echo '</li>';
    }
    echo '</ul>';
}else {
    echo "0 results";
}

// Close the database connection
$db->disconnect();
// Or, you can simply close the connection using $conn->close(); if you prefer.

// Function to determine the color class based on status
function getStatusColorClass($status)
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
?>
</main>

<script type="text/javascript">
    document.addEventListener("DOMContentLoaded", () => {
        const navbar = document.getElementById("navbar");
        const sidebar = document.getElementById("sidebar");
        const btnSidebarToggler = document.getElementById("btnSidebarToggler");
        const navClosed = document.getElementById("navClosed");
        const navOpen = document.getElementById("navOpen");

        btnSidebarToggler.addEventListener("click", (e) => {
            e.preventDefault();
            sidebar.classList.toggle("show");
            navClosed.classList.toggle("hidden");
            navOpen.classList.toggle("hidden");
        });

        sidebar.style.top = parseInt(navbar.clientHeight) - 1 + "px";
    });
</script>
</body>
</html>
<?php
require_once('../model/taskModel.php');
class taskcontroller
{

    public function DisplayTasks()
    {
        if (isset($_GET['idpro'])) {
            $idpro = $_GET['idpro'];
            $iduser = $_SESSION['iduser'];
            $task = new TaskModel();
            return $task->DisplayTask($iduser, $idpro);
        }
    }

    public function AddTasks()
    {
        if (isset($_GET['idpro'])) {
            $idpro = $_GET['idpro'];
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addtask'])) {
                $task = new TaskModel();
                $task->setNomta($_POST['nomta']);
                $task->setDescta($_POST['descta']);
                $task->setDatedeb($_POST['datedeb']);
                $task->setDatefin($_POST['datefin']);
                $task->setStatut($_POST['statut']);
                $iduser = $_SESSION['iduser'];
                $task->AddTask($iduser, $idpro);
                header("Location: tasks.php?task&idpro=$idpro");
                exit();
            }
        }
    }

    public function EditTasks()
    {
        $task = new TaskModel();
        if (isset($_GET['idpro'])) {
            $idpro = $_GET['idpro'];
        if (isset($_POST['edittask']) && isset($_POST['idta'])) {
                $idta = $_POST['idta'];
                $task->setNomta($_POST['nomta']);
                $task->setDescta($_POST['descta']);
                $task->setDatedeb($_POST['datedeb']);
                $task->setDatefin($_POST['datefin']);
                $task->setStatut($_POST['statut']);
                $task->EditTasks($idta);
                header("Location: tasks.php?task&idpro=$idpro");
                exit();
            }
        }
        
    }

    public function DeleteTasks()
    {
        if (isset($_GET['idpro'])) {
            $idpro = $_GET['idpro'];
            if (isset($_GET['deletetask']) && isset($_GET['idta'])) {
                $idta = $_GET['idta'];
                $idpro = $_GET['idpro'];
                $task = new TaskModel();
                $task->DeleteTask($idta);
                header("Location: tasks.php?task&idpro=$idpro");
                exit();
            }
        }
    }

    public function ArchiveTasks()
    {
        if (isset($_GET['idpro'])) {
            $idpro = $_GET['idpro'];
            if (isset($_GET['archivetask']) && isset($_GET['idta'])) {
                $idta = $_GET['idta'];
                $idpro = $_GET['idpro'];
                $task = new TaskModel();
                $task->ArchiveTask($idta);
                header("Location: tasks.php?task&idpro=$idpro");
                exit();
            }
        }
    }

    public function getTaskCount()
    {

        if (isset($_GET['idpro'])) {
            $idpro = $_GET['idpro'];
            $iduser = $_SESSION['iduser'];
            $task = new TaskModel();
            $todoCount = $task->getTaskCount($iduser, $idpro, 'to do');
            $doingCount = $task->getTaskCount($iduser, $idpro, 'doing');
            $doneCount = $task->getTaskCount($iduser, $idpro, 'done');

            return [
                'todoCount' => $todoCount,
                'doingCount' => $doingCount,
                'doneCount' => $doneCount,
            ];
        }
    }
    
    public function TasksFinished()
    {
            $iduser = $_SESSION['iduser'];
            $task = new TaskModel();
            return $task->TasksFinished($iduser);
    }
    public function MostTasks()
    {
            $iduser = $_SESSION['iduser'];
            $task = new TaskModel();
            return $task->MostTasks($iduser);
    }
    public function lessTasks()
    {
            $iduser = $_SESSION['iduser'];
            $task = new TaskModel();
            return $task->lessTasks($iduser);
    }
    public function DONE()
    {
            $iduser = $_SESSION['iduser'];
            $task = new TaskModel();
            return $task->DONE($iduser);
    }
    public function SearchTasks()
    {
        if (isset($_POST['query'])) {
            $searchQuery = $_POST['query'];
            $task = new TaskModel();

            $tasks = $task->SearchTask($searchQuery);

            foreach ($tasks as $task) {
                echo '<div class="flex flex-col flex-shrink-0 w-72">';
                echo '<div class="flex flex-col pb-2 overflow-auto">';
                    echo '<div class="relative flex flex-col items-start p-4 mt-3 bg-white rounded-lg cursor-pointer bg-opacity-90 group hover:bg-opacity-100" draggable="true">
                    <button class="absolute top-0 right-0 flex items-center justify-center hidden w-5 h-5 mt-3 mr-2 text-gray-500 rounded hover:bg-gray-200 hover:text-gray-700 group-hover:flex">
                        <svg class="w-4 h-4 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path d="M10 6a2 2 0 110-4 2 2 0 010 4zM10 12a2 2 0 110-4 2 2 0 010 4zM10 18a2 2 0 110-4 2 2 0 010 4z" />
                        </svg>
                    </button>';
                    echo '<span class="flex items-center h-6 px-3 text-xs font-semibold text-yellow-500 bg-yellow-100 rounded-full">' . $task['nomta'] . '</span>';
                    echo'<h4 class="mt-3 text-sm font-medium">' . $task['descta'] . '</h4>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';

            }
        }
    }
}

                    
$task = new taskcontroller();
$task->SearchTasks();


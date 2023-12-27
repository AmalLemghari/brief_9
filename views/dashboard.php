<?php
require_once '../models/User.php';
$userData = [
    'id' => 1,
    'username' => 'Mery Smith',
    'passwordHash' => 'hashed_password', // Vous devriez normalement récupérer le hash depuis la base de données
    'role' => 'admin',
];

$user = new User($userData['id'], $userData['username'], $userData['passwordHash'], $userData['role']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tableau de bord</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .welcome-message {
            font-size: 18px;
            font-weight: bold;
            color: #4A4A4A; 
            margin: 0;
            position: absolute;
            top: 15%;
            left: 55%;
            transform: translate(-50%, -50%);
        }
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

<p class="welcome-message">Bienvenue, <?= $user->getUsername(); ?> !</p>

<nav id="navbar" class="fixed top-0 z-40 flex w-full flex-row justify-end bg-gray-700 px-4 sm:justify-between">
    <ul class="breadcrumb hidden flex-row items-center py-4 text-lg text-white sm:flex">
        <li class="inline">
            <a href="#">Main</a>
        </li>
        <li class="inline">
            <span>Homepage</span>
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

<main>
    <!-- your content goes here -->
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

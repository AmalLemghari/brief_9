<?php
session_start();

require_once '../models/Database.php';

$database = Database::getInstance();
$conn = $database->connect();

$confirmationMessage = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $checkLoginQuery = "SELECT * FROM users WHERE username = :username";
    $checkLoginStmt = $conn->prepare($checkLoginQuery);
    $checkLoginStmt->bindParam(':username', $username);
    $checkLoginStmt->execute();
    $user = $checkLoginStmt->fetch();

    if ($user && password_verify($password, $user['password_hash'])) {
        $_SESSION['username'] = $username;
        // echo "Login successful!";
        header('Location: dashboard.php'); // Redirection vers la page du tableau de bord
        exit();
    } else {
        echo "Login failed. Invalid username or password.";
    }
}

$database->disconnect();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Connexion</h1>

    <!-- Formulaire de connexion -->
    <form action="login.php" method="post">
        <label for="username">Nom d'utilisateur:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Mot de passe:</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Se connecter</button>
    </form>

    <p>Vous n'avez pas de compte ? <a href="register.php">Inscrivez-vous ici</a></p>
</body>
</html>

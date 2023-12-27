<?php
require_once '../models/Database.php';

$database = Database::getInstance();
$conn = $database->connect();

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$confirmationMessage = '';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];  

    $checkUsernameQuery = "SELECT * FROM users WHERE username = :username";
    $checkUsernameStmt = $conn->prepare($checkUsernameQuery);
    $checkUsernameStmt->bindParam(':username', $username);
    $checkUsernameStmt->execute();

    if ($checkUsernameStmt->rowCount() > 0) {
        echo "Error: Le nom d'utilisateur '$username' est déjà pris.";
    } else {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $insertQuery = "INSERT INTO users (username, email, password_hash, role) VALUES (:username, :email, :password, 'user')";
        $insertStmt = $conn->prepare($insertQuery);
        $insertStmt->bindParam(':username', $username);
        $insertStmt->bindParam(':email', $email);  
        $insertStmt->bindParam(':password', $hashedPassword);

        if ($insertStmt->execute()) {
            echo "Registration successful!";
        } else {
            $errorInfo = $insertStmt->errorInfo();
            echo "Error: " . $insertQuery . "<br>" . "Error Info: " . print_r($errorInfo, true);
        }
    }
}

$database->disconnect();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Inscription</h1>

    <?php if (!empty($confirmationMessage)) : ?>
        <p><?php echo $confirmationMessage; ?></p>
    <?php else : ?>
        <form action="register.php" method="post">
            <label for="username">Nom d'utilisateur:</label>
            <input type="text" id="username" name="username" required>

            <label for="email">Adresse e-mail:</label> 
            <input type="email" id="email" name="email" required>

            <label for="password">Mot de passe:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">S'inscrire</button>
        </form>

        <p>Vous avez déjà un compte ? <a href="login.php">Connectez-vous ici</a></p>
    <?php endif; ?>
</body>
</html>

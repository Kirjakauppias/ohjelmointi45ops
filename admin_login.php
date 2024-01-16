<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>

    <?php
    session_start();

    //Käsitellään lomakkeen lähetys
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        require_once 'login_process.php';
    }
    ?>

    <form action="admin_login.php" method="post">
        
        <label for="username">Username:</label>
        <input type="text" name="username" required>

        <label for="password">Password:</label>
        <input type="password" name="password" required>

        <input type="submit" name="submit" value="Login">
    </form>
</body>
</html>
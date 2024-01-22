<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <?php
    echo "<pre>";
    var_dump($_SESSION);
    echo "</pre>";
    ?>
    <h1>Ylläpitäjän sivut</h1>

    
    <?php if (isset($_SESSION["from_login_page"]) && isset($_SESSION['user_username']) && $_SESSION['user_type'] === 'Admin'){
        echo "<a href='view_users.php'>Käyttäjälistaus</a><br>"; 
        echo "<a href='view_products.php'>Tuotelistaus</a><br>";
        echo "<a href='view_orders.php'>Tilauslistaus</a><br>";
    ?>
        <!-- Add a log-out button -->
                    <form action="includes/logout.inc.php" method="post">
                        <button type="submit" name="logout">Kirjaudu ulos</button>
                    </form>
    <?php
    } else {
        echo "Sinulla ei ole admin -oikeuksia!<br>";
        echo "<a href='index.php'>Palaa etusivulle</a>";
}
?>

</body>
</html>
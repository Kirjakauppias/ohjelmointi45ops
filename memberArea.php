<?php
    session_start();
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<div>
        <?php
        // Tarkistetaan, onko painiketta painettu
        if(isset($_POST['logout'])) {
            // Poistetaan käyttäjän istunto
            session_destroy();
            // Ohjataan käyttäjä takaisin index.php-sivulle
            header("Location: index.php");
            exit();
        }
        ?>
        <form method="post" class="logout-button">
            <input type="submit" name="logout" value="Kirjaudu ulos">
        </form>
    </div>
</body>
</html>
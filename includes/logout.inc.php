<?php

    function logoutInput(){
        $_SESSION['from_member_area'] = true;
        // Tarkistetaan, onko painiketta painettu
        if(isset($_POST['logout'])) {
            // Poistetaan käyttäjän istunto
            session_destroy();
            // Ohjataan käyttäjä takaisin index.php-sivulle
            header("Location: index.php");
            exit();
        }
    }
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form method="post" class="logout-button">
        <button type="submit" name="logout">
            <img src="images/logout.png">
        </button>
</form>
    
</body>
</html>
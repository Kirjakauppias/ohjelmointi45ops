<?php
    session_start();
    logoutInput();
    function logoutInput(){
        $_SESSION['from_member_area'] = true;
        // Tarkistetaan, onko painiketta painettu
        if(isset($_POST['logout'])) {
            // Poistetaan käyttäjän istunto
            session_destroy();
            // Ohjataan käyttäjä takaisin index.php-sivulle
            header("Location: ../index.php");
            exit();
        }
    }
?>
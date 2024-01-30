<?php
//TÄSSÄ TIEDOSTOSSA KÄYDÄÄN LÄPI TIETOA ETTÄ ONKO KÄYTTÄJÄ KIRJAUTUNUT SISÄÄN.
declare(strict_types=1);

// Funktio joka tarkistaa että käyttäjä on kirjautunut sisään omalla tunnuksellaan
// ja että käyttäjä on saapunut login.inc.php -sivulta.
function output_username() {
    if(isset($_SESSION["user_id"])) {
        echo "You are logged in as " . $_SESSION["username"];
    } else {
        //echo "You are not logged in";
    }
}

function check_login_errors() {
    if (isset($_SESSION["errors_login"])) {
        $errors = $_SESSION["errors_login"];

        foreach($errors as $error) {
            echo "<p>" . $error . "</p>";
        }

        unset($_SESSION["errors_login"]);
    } 
}


<?php
include 'includeFunctions.php';
includeUpperElements();
// Tarkista, onko saavuttu login-sivulta
if (isset($_SESSION["from_login_page"]) && isset($_SESSION['user_username']) ) {
    $username = $_SESSION['user_username'];
    echo "Tervetuloa $username!";

    echo "<pre>";
    echo "Käyttäjätunnus: " . $_SESSION['username'] . "<br>";
    echo "Email: " . $_SESSION['email'] . "<br>";
    echo "Etunimi: " . $_SESSION['firstname'] . "<br>";
    echo "Sukunimi: " . $_SESSION['lastname'] . "<br>";
    echo "Osoite: " . $_SESSION['address'] . "<br>";
    echo "</pre>";
    
    }else {
        // Jos käyttäjä ei ole kirjautunut sisään, ohjataan takaisin login-sivulle
        echo "Et ole kirjatunut sisään.";
    }
includeBottomElements();
?>
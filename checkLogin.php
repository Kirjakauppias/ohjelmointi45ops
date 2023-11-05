<?php
session_start(); //Tarvitaan sessiota varten

if($_SERRVER["REQUEST_METHOD"] == "POST") {
    //Jos vertailu on true
    //Tarkistetaan onko käyttäjänimi ja salsana oikein
    //1. otetaan tunnut ja salasana muuttujiin talteen
    $username = $_POST["username"];
    $password = $_POST["password"];

    if($username == "mikko79") {
        if($password == "s123") {
            //Tiedot oikein
            // Lisätään koodi, jotta käyttäjä on "kirjautunut sisään" ja tietoja ei tarvitse syöttää joka kerta
            $_SESSION["username"] = $username; // Käyttäjän sessiossa on "username"-avain, hän on kirjautunut
            header("Location: memberArea.php");
        }
    }
}
?>
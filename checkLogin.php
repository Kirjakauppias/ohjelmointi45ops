<?php
session_start(); //Tarvitaan sessiota varten

if($_SERVER["REQUEST_METHOD"] == "POST") {
    //Jos vertailu on true
    //Tarkistetaan onko käyttäjänimi ja salsana oikein
    //1. otetaan tunnut ja salasana muuttujiin talteen
    $inputUsername = $_POST["username"]; 
    $inputPassword = $_POST["password"]; 

    $servername = "localhost";
    $databasename = "verkkokauppa";
    $username = "root";
    $dbpassword = "";

    try {
        // Luodaan yhteys MySLi tai PDO
        $DBconn = new PDO("mysql:host=$servername;dbname=$databasename", $username, $dbpassword);
        // Tässä objektissa on tallessa tietokantayhteys

        // Virhe asetuksia
        $DBconn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $query = "SELECT * FROM users";
        $stmt = $DBconn->prepare($query);
        $stmt->execute();

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
            $usernameDB = $row['FirstName']; 
            $passwordDB = $row['Password']; 

            if ($inputUsername == $usernameDB && password_verify($inputPassword, $passwordDB)) {
                //Tiedot oikein
                //Lisätään koodi, jotta käyttäjä on "kirjautunut sisään" ja tietoja ei tarvitse syöttää joka kerta
                $_SESSION["username"] = $usernameDB; 
                header("Location: memberArea.php");
                exit();
            }
        }
        // If no match is found
        //header("Location: login.php?error=login");
        //exit();
    } catch (PDOException $e) {
        echo "Virhe: " . $e->getMessage();
    }
} else {
    header("Location: login.php");
    exit();
}
?>
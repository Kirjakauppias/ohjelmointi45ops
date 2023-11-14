<?php
session_start();

$servername = "localhost";
$databasename = "verkkokauppa";
$username = "root";
$dbpassword = "";

try {
    // Luodaan yhteys MySLi tai PDO
    $conn = new PDO("mysql:host=$servername;dbname=$databasename", $username, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Tehdään tietokanta-kysely kirjautumista varten.
    $login_query = "SELECT * FROM users";
        $stmt = $conn->prepare($login_query);
        $stmt->execute();

    if($_SERVER["REQUEST_METHOD"] == "POST") {  //Login-sivulta on täytetty kirjautumislomake
        $usernameInput = $_POST["username"];    //Alustetaan muuttujat login-sivulta siirretyillä tiedoilla
        $passwordInput = $_POST["password"];
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { //Loopataan user-tietokannasta
            $usernameDB = $row['Email'];                //Alustetaan muuttujat user-tietokannasta olevilla tiedoilla / rivi
            $passwordDB = $row['Password'];

            if ($usernameInput == $usernameDB && $passwordInput == $passwordDB){    //Jos login-lomakkeella annetut tiedot täsmäävät tietokannan riviin
                //Tiedot oikein
                //Lisätään koodi, jotta käyttäjä on "kirjautunut sisään".
                $_SESSION["username"] = $usernameDB; 
                header("Location: memberArea.php");
                exit();
            }
        }
        header("Location: login.php?error=login");
        exit();
    }
}
catch (PDOException $e) {
    echo "Virhe: " . $e->getMessage();
}
?>
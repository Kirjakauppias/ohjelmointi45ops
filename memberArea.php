<?php
include 'includeFunctions.php';
includeUpperElements();
// Tarkista, onko saavuttu login-sivulta
if (isset($_SESSION["from_login_page"]) && isset($_SESSION['user_username']) ) {
    $username = $_SESSION['user_username'];
    echo "Tervetuloa $username!";

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        //Kästellään lomakkeen tietoja tässä:
        //Päivitä tietokantaan tarvittaessa.

        //Tarkistetaan, onko annettu salasana ja onko se oikea:
        if(!empty($_POST['password'])){
            //Salasana on annettu, tarkista se.
            $enteredPassword = $_POST['password'];

            //Haetaan tietokannasta salasana.
            $storedPasswordHash = $_SESSION['password'];

            //Tarkistetaan salasana hashin avulla.
            if (password_verify($enteredPassword, $storedPasswordHash)){
                //Salana on oikein. Päivitetään muut tiedot.
                echo "Tietosi on päivitetty!";
            } else {
                echo "Virheellinen salasana!";
            }
        } else {
            //Salasanaa ei annettu, päivitä muut tiedot.
            echo "Tietosi on päivitetty!";
        }
    } else {
        //Näytetään lomake käyttäjän tietojen muokkaamiseen.
        echo "
            <form method='post' action=''>
                <label for='firstname'>Etunimi:</label>
                    <input type='text' name='firstname' value='{$_SESSION['firstname']}'><br>
                <label for='lastname'>Sukunimi:</label>
                    <input type='text' name='lastname' value='{$_SESSION['lastname']}'><br>
                <label for='address'>Osoite:</label>
                    <input type='text' name='address' value='{$_SESSION['address']}'><br>
                <label for='password'>Salasana:</label>
                    <input type='password' name='password'><br>
                    
                    <input type='submit' value='Tallenna'>
            </form>
            ";
    }
    echo "<pre>";
    echo "Käyttäjätunnus: " . $_SESSION['username'] . "<br>";
    echo "Email: " . $_SESSION['email'] . "<br>";
    echo "Etunimi: " . $_SESSION['firstname'] . "<br>";
    echo "Sukunimi: " . $_SESSION['lastname'] . "<br>";
    echo "Osoite: " . $_SESSION['address'] . "<br>";
    echo "</pre>";
} 
else {
        //Käyttäjä ei ole kirjautunut sisään
        echo "Et ole kirjatunut sisään.";
    }
    
includeBottomElements();
?>
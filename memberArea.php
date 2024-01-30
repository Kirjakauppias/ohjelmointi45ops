<?php
declare(strict_types=1);
// TÄSSÄ TIEDOSTOSSA ON KIRJAUTUNEEN KÄYTTÄJÄN TIEDOT JA MUOKKAUSMAHDOLLISUUS
require_once 'includes/db_enquiry.inc.php';
include 'includes/functions.inc.php';
include 'functions_partials.php';   // Tiedosto jossa on partials -tiedostot funktioina.

includeUpperElements();             // HTML rakennefunktio.

echo "<div class='member-info'>";
// Tarkista, onko saavuttu login-sivulta
if (isset($_SESSION["from_login_page"]) && isset($_SESSION['user_username'])) {
    
    // Haetaan käyttäjän tiedot tietokannasta
    $userID = $_SESSION['user_id'];
    $userDetails = getUserDetails($pdo_conn, $userID);
    
    echo "<h2>Henkilökohtaiset tietosi</h2>";
    printUserDetails($userDetails);  // Tulostetaan käyttäjän tiedot.
    
    if($_SERVER['REQUEST_METHOD'] === 'POST') {

        // Tarkistetaan salasanan vaihto.
        if(isset($_POST['password_update'])){
            $currentPassword = isset($_POST['currentpassword']) ? $_POST['currentpassword'] : null;
            $newPassword = $_POST['newpassword'];
            $confirmPassword = $_POST['passwordconfirm'];
    
            // Tarkistetaan, että currentpassword on annettu
            if ($currentPassword !== null) {
                // Tarkista nykyinen salasana
                if (password_verify($currentPassword, $userDetails['Password'])) {
                    // Tarkistetaan että uusi salasana ja vahvistus ovat samat.
                    if ($newPassword === $confirmPassword) {
                        // Päivitetään tietokantaan uusi salasana.
                        $updatePasswordQuery = $pdo_conn->prepare("UPDATE users SET Password=? WHERE UserID=?");
                        $updatePasswordQuery->execute([password_hash($newPassword, PASSWORD_DEFAULT), $userID]);
    
                        echo "Salasanasi on päivitetty!";
                    } else {
                        echo "Uusi salasana ja vahvistus eivät täsmää!";
                    }
                } else {
                    echo "Nykyistä salasanaa ei annettu!";
                }
            }
        }

        // Kästellään lomakkeen tietoja tässä:
        // Päivitä tietokantaan tarvittaessa.
        $updatedFields = []; // Tähän muuttujaan kerätään ne tiedot, jotka on laitettu lomakkeeseen
        
        // Jos lomakkeen kohta on tyhjä, se jätetään päivittämättä.
        if(!empty($_POST['username'])) {
            $updatedFields['Username'] = htmlspecialchars($_POST['username']);
        }
        if(!empty($_POST['firstname'])) {
            $updatedFields['FirstName'] = htmlspecialchars($_POST['firstname']);
        }
        if(!empty($_POST['lastname'])) {
            $updatedFields['LastName'] = htmlspecialchars($_POST['lastname']);
        }
        if(!empty($_POST['address'])) {
            $updatedFields['Address'] = htmlspecialchars($_POST['address']);
        }
        if(!empty($_POST['email'])) {
            $updatedFields['Email'] = htmlspecialchars($_POST['email']);
        }
        $userId = $_SESSION['user_id'];
        
        // Jos käyttäjä on painanut tallenna -buttonia ja lomakkeessa on jotain tietoa.        
        if (isset($_POST['user_update']) && !empty($updatedFields)) {
            // Päivitetään tietokantaa.
            $updateQuery = $pdo_conn->prepare("UPDATE users SET " . implode('=?, ', array_keys($updatedFields)) . "=? WHERE UserID=?");
            $updateQuery->execute(array_merge(array_values($updatedFields), [$userId]));
                    
            echo "Tietosi on päivitetty! Uudet tiedot tulevat näkyviin kun kirjaudut uudelleen.";
        }
    }
    echo "</div>";
    echo "<div class='update-form'>";
    echo "<h2>Päivitä tietosi</h2>";

    // Näytetään lomake käyttäjän tietojen muokkaamiseen.
    echo "<form method='post' action='' class='member-update-form'>";
        echo "<input type='text' name='username' placeholder='Käyttäjätunnus: '> <br>";
        echo "<input type='text' name='firstname' placeholder='Etunimi: '> <br>";
        echo "<input type='text' name='lastname' placeholder='Sukunimi: '> <br>";
        echo "<input type='text' name='address' placeholder='Osoite: '> <br>";
        echo "<input type='text' name='email' placeholder='E-mail: '> <br>";
        echo "<button type='submit' name='user_update'>" . "Tallenna" . "</button>";
    echo "</form>";

    // Näytetään lomake salasanan muuttamiseen.
    echo "<form method='post' action='' class='password-update-form'>";
        echo "<input type='password' name='currentpassword' placeholder='Nykyinen salasana: '> <br>";
        echo "<input type='password' name='newpassword' placeholder='Uusi salasana: '> <br>";
        echo "<input type='password' name='passwordconfirm' placeholder='Vahvista uusi salasana: '> <br>";
        echo "<button type='submit' name='password_update'>" . "Vaihda salana" . "</button>";
    echo "</form>";

    echo "</div>"; 
    echo "</div>";
}
else { echo "<h3>Sinun on kirjauduttava nähdäksesi henkilökohtaiset tietosi.</h3>"; }
includeBottomElements();
        
    /*    echo "<pre>";
        var_dump($_SESSION);
        echo "</pre>";*/
?>

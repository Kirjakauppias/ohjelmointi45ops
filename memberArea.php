<?php
require_once 'includes_other/dbconn.php';
include 'includeFunctions.php';
includeUpperElements();
// Tarkista, onko saavuttu login-sivulta
echo "<div class='member-container'>";
    echo "<div>";
if (isset($_SESSION["from_login_page"]) && isset($_SESSION['user_username']) ) {
    
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        //Kästellään lomakkeen tietoja tässä:
        //Päivitä tietokantaan tarvittaessa.

        //Tarkistetaan, onko annettu uusi salasana ja onko se oikea:
        if(!empty($_POST['new_password']) && $_POST['new_password'] === $_POST['confirm_password']){
            //Uusi salasana on annettu ja vahvistettu oikein.
            //Päivitetään tietokantaan käyttäjän tiedot, mukaan lukien salasana
                
                $updatedFirstname = $_POST['firstname'];
                $updatedLastname = $_POST['lastname'];
                $updatedAddress = $_POST['address'];
                $updatedUsername = $_POST['username'];
                $updatedPassword = password_hash($_POST['new_password'], PASSWORD_DEFAULT); //Salasana haetaan ennen tallentamista.
                $userId = $_SESSION['id'];

                //Suojaudutaan SQL-injektiota vastaan.
                $updateQuery = $conn->prepare("UPDATE users SET FirstName=?, LastName=?, Address=?, Username=?, Password=? WHERE UserID=?");
                $updateQuery->execute([$updatedFirstname, $updatedLastname, $updatedAddress, $updatedUsername, $updatedPassword, $userId]);

                echo "Tietosi on päivitetty! Uudet tiedot tulevat näkyviin kun kirjaudut uudelleen.";
            } elseif (empty($_POST['new_password'])) {
            //Salasanaa ei annettu, päivitä muut tiedot.
            $updatedFirstname = $_POST['firstname'];
            $updatedLastname = $_POST['lastname'];
            $updatedAddress = $_POST['address'];
            $updatedUsername = $_POST['username'];
            $userId = $_SESSION['id'];

            $updateQuery = $conn->prepare("UPDATE users SET FirstName=?, LastName=?, Address=?, Username=? WHERE UserID=?");
            $updateQuery->execute([$updatedFirstname, $updatedLastname, $updatedAddress, $updatedUsername, $userId]);
            echo "Tietosi on päivitetty! Uudet tiedot tulevat näkyviin kun kirjaudut uudelleen.";
        } else {
            echo "Uusi salasana ja vahvistus eivät täsmää!";
        }
    } 
        //echo "<div>";
        echo "<h2>Henkilökohtaiset tietosi:</h2>";
        echo "<pre>";
            printUserDetails();
        echo "</pre>";
        echo "</div>";

    // Näytetään Päivitä tietosi -painike ja lisätään JavaScript, joka piilottaa ja näyttää lomakkeen tarvittaessa
    echo "<div class='update-form'>";
        echo "<button onclick='toggleForm()'>Päivitä tietosi</button>";
            echo "<div id='update-form' style='display:block;'>";
                // Näytetään lomake käyttäjän tietojen muokkaamiseen.
                createUpdateForm();
            echo "</div>";
    echo "</div>";
echo "</div>";
} else {
    // Käyttäjä ei ole kirjautunut sisään
    echo "Et ole kirjautunut sisään.";
}
echo "</div>";
echo "</div>";
    
includeBottomElements();
?>

<script>
    function toggleForm() {
        var form = document.getElementById('update-form');
        if (form.style.display === 'none') {
            form.style.display = 'block';
        } else {
            form.style.display = 'none';
        }
    }
</script>
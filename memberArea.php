<?php
session_start();

include 'partials/doc.php';
include 'partials/header.php';
include 'partials/nav.php';
?>
<main>
<?php
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
        header("Location: login.php");
        exit();
    }


    // Tarkistetaan, onko painiketta painettu
    if(isset($_POST['logout'])) {
        // Poistetaan käyttäjän istunto
        session_destroy();
        // Ohjataan käyttäjä takaisin index.php-sivulle
        header("Location: index.php");
        exit();
    }
    unset($_SESSION["from_login_page"]);
?>
</main>
<?php
    include 'partials/footer.php';
    include 'partials/htmlEnd.php';
?>
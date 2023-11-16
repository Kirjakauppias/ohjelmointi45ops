<?php
    session_start();

    // Tarkistetaan, onko käyttäjä kirjautunut sisään
    if (!isset($_SESSION["username"])) {
        // Istuntoa ei ole asetettu, ohjataan käyttäjä kirjautumissivulle
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

    include 'includes/dbsearchbar.php';
    include 'partials/doc.php';       
    include 'partials/headerLogged.php';
    include 'partials/nav.php'; 

    echo "<div class='member-area-main'>";
            echo "<h2>Tervetuloa " . $_SESSION["username"] . "!</h2>";
    echo "</div>";

    include 'partials/footer.php';
    include 'scripts/navScript.php';
    include 'partials/htmlEnd.php';
?>

   
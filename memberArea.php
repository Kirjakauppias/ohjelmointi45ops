<?php
    $_SESSION['from_member_area'] = true;
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


    include 'partials/footer.php';
    include 'scripts/navScript.php';
    include 'partials/htmlEnd.php';
?>

   
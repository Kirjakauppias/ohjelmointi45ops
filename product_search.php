<?php
    //SIVU JOSSA NÄYTETÄÄN NE TUOTTEET, JOTKA LÖYTYIVÄT SEARCHBAR -HAKUKENTÄSTÄ
    require_once 'includes_other/dbconn.php';
    include 'partials/doc.php';
    include 'partials/header.php';
    include 'partials/nav.php';

    echo "<main>";
        
    // Tarkistetaan, onko searchabariin annettu joku sana joka haetaan osoitekentästä ?search=
     if (isset($_GET['search'])) {      
        $searchTerm = $_GET['search'];  //Annetaan muuttujalle osoitekentän arvo.
        // Suoritetaan haku tietokannasta hakutermin perusteella
        $products_kysely = $conn->prepare("SELECT * FROM products WHERE ProductName LIKE :searchTerm");
        $products_kysely->bindValue(':searchTerm', '%' . $searchTerm . '%', PDO::PARAM_STR);
        $products_kysely->execute();
        
        include 'loops/all_products.loop.php';

    } else {
        // Jos hakuterminä ei ole annettu, ohjataan käyttäjä takaisin etusivulle
        echo "Tuotteita ei löytynyt!";
        //header("Location: index.php");
        exit();
    }

        
        
    
echo "</main>";

    include 'partials/footer.php';
    include 'scripts/navScript.php';
    include 'partials/htmlEnd.php';
?>
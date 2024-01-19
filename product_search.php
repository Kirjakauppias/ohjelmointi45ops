<?php
//SIVU JOSSA NÄYTETÄÄN NE TUOTTEET, JOTKA LÖYTYIVÄT SEARCHBAR -HAKUKENTÄSTÄ
include 'includeFunctions.php';
require_once 'includes_other/dbconn.php';
require_once 'includes_other/dbenquiry.php';
include 'loops/product_model.php';

includeUpperElements();
    // Tarkistetaan, onko searchabariin annettu joku sana joka haetaan osoitekentästä ?search=
     if (isset($_GET['search'])) {      
        $searchTerm = $_GET['search'];  //Annetaan muuttujalle osoitekentän arvo.
        //Funktio joka hakee tietokannasta tuotteet hakusanan perusteella.
        $products = getProductsBySearchTerm($conn, $searchTerm);
        //Funktio joka tulostaa haetut tuotteet.
        printSearchedProducts($products);

    } else {
        // Jos hakuterminä ei ole annettu, ohjataan käyttäjä takaisin etusivulle
        echo "Tuotteita ei löytynyt!";
        exit();
    }    
includeBottomElements();
?>
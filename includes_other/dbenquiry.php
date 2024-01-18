<?php
    //Haetaan tuotteita randomilla
    //Index-sivulla
    function getRandomProducts($conn){
        $random_products_kysely = "SELECT * FROM products ORDER BY RAND()"; //ORDER BY RAND() antaa satunnaisjärjestyksen.
        $random_stmt = $conn->prepare($random_products_kysely);
        $random_stmt->execute();
        return $random_stmt->fetchAll();
    }
    
    //Funktio joka hakee kaikki tuotteet
    function getAllProducts($conn) {
        $products_kysely = $conn->prepare("SELECT * FROM products");
        $products_kysely->execute();
        return $products_kysely->fetchAll();
    }
    
    //Funktio joka hakee tietyn tuotteen ID:n perusteella
    //product_display.php -sivulla
    function getProductByID($conn, $productID){
        $products_kysely = $conn->prepare("SELECT * FROM products WHERE ProductID = :productID");
        $products_kysely->bindParam(':productID', $productID);
        $products_kysely->execute();
        return $products_kysely->fetch();
    }
    
    //SÄILYTETÄÄN VARMUUDEN VUOKSI
    /*Funktio tietokantakyselylle kirjautumista varten
    //Tällä hetkellä ei ole käytössä
    function getUserDataForLogin($conn) {
        $login_query = "SELECT * FROM users";
        $stmt = $conn->prepare($login_query);
        $stmt->execute();
        return $stmt->fetchAll();
    }*/


<?php
    require_once 'dbconn.php';
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

    //Funktio jota käytetään shopping_cart.php -sivulla
    function getProductToCart($conn, $tuoteID) {
        $tuoteKysely = "SELECT * FROM products WHERE ProductID = ?";
        $tuoteValmistelu = $conn->prepare($tuoteKysely);
        $tuoteValmistelu->bindParam(1, $tuoteID, PDO::PARAM_INT);
        $tuoteValmistelu->execute();
        $tuoteTiedot = $tuoteValmistelu->fetch(PDO::FETCH_ASSOC);
        return $tuoteTiedot;
    }

    function getProductsBySearchTerm($conn, $searchTerm) {
        $products_query = "SELECT * FROM products WHERE ProductName LIKE :searchTerm";
        $products_stmt = $conn->prepare($products_query);
        $products_stmt->bindValue(':searchTerm', '%' . $searchTerm . '%', PDO::PARAM_STR);
        $products_stmt->execute();
        return $products_stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /*function searchProduct($conn, $searchTerm) {
        $products_kysely = $conn->prepare("SELECT * FROM products WHERE ProductName LIKE :searchTerm");
        $products_kysely->bindValue(':searchTerm', '%' . $searchTerm . '%', PDO::PARAM_STR);
        $products_kysely->execute();
        return $products_kysely->fetchAll(PDO::FETCH_ASSOC);
    }*/

    
    
    //SÄILYTETÄÄN VARMUUDEN VUOKSI
    /*Funktio tietokantakyselylle kirjautumista varten
    //Tällä hetkellä ei ole käytössä
    function getUserDataForLogin($conn) {
        $login_query = "SELECT * FROM users";
        $stmt = $conn->prepare($login_query);
        $stmt->execute();
        return $stmt->fetchAll();
    }*/


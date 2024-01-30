<?php
//TÄSSÄ TIEDOSTOSSA ON TUOTTEIDEN HAUT TIETOKANNASTA
declare(strict_types=1);
require_once 'db_connection.inc.php';

//Haetaan tuotteita randomilla
    //Index-sivulla
    function getRandomProducts($pdo_conn){
        $random_products_kysely = "SELECT * FROM products ORDER BY RAND()"; //ORDER BY RAND() antaa satunnaisjärjestyksen.
        $random_stmt = $pdo_conn->prepare($random_products_kysely);
        $random_stmt->execute();
        return $random_stmt->fetchAll();
    }
    
    //Funktio joka hakee kaikki tuotteet
    function getAllProducts($pdo_conn) {
        $products_kysely = $pdo_conn->prepare("SELECT * FROM products");
        $products_kysely->execute();
        return $products_kysely->fetchAll();
    }
    
    //Funktio joka hakee tietyn tuotteen ID:n perusteella
    //product_display.php -sivulla
    function getProductByID($pdo_conn, $productID){
        $products_kysely = $pdo_conn->prepare("SELECT * FROM products WHERE ProductID = :productID");
        $products_kysely->bindParam(':productID', $productID);
        $products_kysely->execute();
        return $products_kysely->fetch();
    }

    //Funktio jota käytetään shopping_cart.php -sivulla
    function getProductToCart($pdo_conn, $tuoteID) {
        $tuoteKysely = "SELECT * FROM products WHERE ProductID = ?";
        $tuoteValmistelu = $pdo_conn->prepare($tuoteKysely);
        $tuoteValmistelu->bindParam(1, $tuoteID, PDO::PARAM_INT);
        $tuoteValmistelu->execute();
        $tuoteTiedot = $tuoteValmistelu->fetch(PDO::FETCH_ASSOC);
        return $tuoteTiedot;
    }

    function getProductsBySearchTerm($pdo_conn, $searchTerm) {
        $products_query = "SELECT * FROM products WHERE ProductName LIKE :searchTerm";
        $products_stmt = $pdo_conn->prepare($products_query);
        $products_stmt->bindValue(':searchTerm', '%' . $searchTerm . '%', PDO::PARAM_STR);
        $products_stmt->execute();
        return $products_stmt->fetchAll(PDO::FETCH_ASSOC);
    }

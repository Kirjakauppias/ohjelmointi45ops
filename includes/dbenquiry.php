<?php
    //Haetaan tuotteita randomilla
    //Index-sivulla
    $products_kysely = $conn->prepare("SELECT * FROM products ORDER BY RAND()");
    $products_kysely->execute();

    //Tehdään tietokanta-kysely kirjautumista varten
    //checkLogin-sivulla
    $login_query = "SELECT * FROM users";
    $stmt = $conn->prepare($login_query);
    $stmt->execute();

    //Tehdään tietokanta-kysely jossa esitetään tietty tuote
    //product_display-sivulla
    $products_query = $conn->prepare("SELECT * FROM products WHERE ProductID = :productID");
    $products_query->bindParam(':productID', $productID);
    $products_query->execute();
    $product = $products_query->fetch();
?>
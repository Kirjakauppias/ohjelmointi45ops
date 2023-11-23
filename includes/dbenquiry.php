<?php
    //Haetaan tuotteita randomilla
    //Index-sivulla
    $random_products_kysely = ("SELECT * FROM products ORDER BY RAND()");
    $random_stmt = $conn->prepare($random_products_kysely);
    $random_stmt->execute();

    

    $products_kysely = $conn->prepare("SELECT * FROM products");
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
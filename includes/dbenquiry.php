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
?>
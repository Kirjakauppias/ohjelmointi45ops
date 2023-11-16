<?php
    //Haetaan tuotteita randomilla
    //Index-sivulla
    $products_kysely = $conn->prepare("SELECT * FROM products ORDER BY RAND()");
?>
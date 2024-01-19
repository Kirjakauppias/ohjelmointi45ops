<?php
// Tarkistetaan, onko hakuterminä annettu
    if (isset($_GET['search'])) {
        $searchTerm = $_GET['search'];
        // Suoritetaan haku tietokannasta hakutermin perusteella
        $products_kysely = $conn->prepare("SELECT * FROM products WHERE ProductName LIKE :searchTerm");
        $products_kysely->bindValue(':searchTerm', '%' . $searchTerm . '%', PDO::PARAM_STR);
        $products_kysely->execute();
        // Ohjataan käyttäjä product_search -sivulle hakutulosten kanssa
        header("Location: product_search.php?search=" . urlencode($searchTerm));
        exit();
    }
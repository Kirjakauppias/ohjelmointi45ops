<?php
//TÄSSÄ TIEDOSTOSSA ON TIETOKANTAHAKUJA
require_once 'db_connection.inc.php';
function getUserDetails($pdo_conn, $userId) {
    $query = $pdo_conn->prepare("SELECT * FROM users WHERE UserID = ?");
    $query->execute([$userId]);
    return $query->fetch(PDO::FETCH_ASSOC);
}

// Tarkistetaan, onko hakuterminä annettu search-barissa.
if (isset($_GET['search'])) {
    $searchTerm = $_GET['search'];
    // Suoritetaan haku tietokannasta hakutermin perusteella
    $products_kysely = $pdo_conn->prepare("SELECT * FROM products WHERE ProductName LIKE :searchTerm");
    $products_kysely->bindValue(':searchTerm', '%' . $searchTerm . '%', PDO::PARAM_STR);
    $products_kysely->execute();
    // Ohjataan käyttäjä product_search -sivulle hakutulosten kanssa
    header("Location: product_search.php?search=" . urlencode($searchTerm));
    exit();
}
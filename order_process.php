<?php
require 'includes_other/dbconn.php';
include 'includes_other/dbsearchbar.php';
include 'partials/doc.php';
include 'partials/header.php';
include 'partials/nav.php';

echo "<main>";
echo "<div class='shopping_cart_table'>";
// Tulosta kaikki $_SESSION -tiedot
//echo "Print_r:\n";
//print_r($_SESSION);
// Tarkista, onko käyttäjä kirjautunut sisään
if (isset($_SESSION['id'])) {
    // Luo tilaus
    $userId = $_SESSION['id'];
    $orderDate = date("Y-m-d H:i:s");
    $status = "Pending"; // Voit määrittää tilauksen tilan tässä
    $totalPrice = array_sum(array_column($_SESSION["cart"], 'price'));

    $orderQuery = "INSERT INTO orders (UserID, OrderDate, Status, TotalPrice) VALUES (?, ?, ?, ?)";
    $orderStmt = $conn->prepare($orderQuery);
    $orderStmt->execute([$userId, $orderDate, $status, $totalPrice]);

    // Hae viimeksi lisätyn tilauksen ID
    $orderId = $conn->lastInsertId();

    // Lisää tilauksen tuotteet
    foreach ($_SESSION["cart"] as $cart_item) {
        $product_id = $cart_item["productID"];
        $quantity = $cart_item["quantity"];
        $subtotal = $cart_item["price"] * $quantity;

        $orderItemsQuery = "INSERT INTO orderitems (OrderID, ProductID, Quantity, Subtotal) VALUES (?, ?, ?, ?)";
        $orderItemsStmt = $conn->prepare($orderItemsQuery);
        $orderItemsStmt->execute([$orderId, $product_id, $quantity, $subtotal]);
    }

    // Tyhjennä ostoskori
    unset($_SESSION["cart"]);
    echo "Tilaus onnistuneesti tallennettu!";
} else {
    echo "Sinun on oltava kirjautunut sisään tehdäksesi tilauksen.";
}

// Sulje tietokantayhteys
$conn = null;

echo "</div>";
echo "</main>";

include 'partials/footer.php';
include 'scripts/navScript.php';
include 'partials/htmlEnd.php';
?>

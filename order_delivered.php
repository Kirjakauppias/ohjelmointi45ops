<?php
session_start();

// Tietokantayhteys
require 'includes_other/dbconn.php';

echo "<main>";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['address'])) {
    // Lomakkeen tiedot
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $address = $_POST['address'];

    // Tarkista, onko ostoskorissa tuotteita
    if (!empty($_SESSION["products"])) {
        // Lisää tilaus tietokantaan
        $query = "INSERT INTO orders (UserID, OrderDate, Status, TotalPrice, FirstName, LastName, Email, Address) VALUES (?, NOW(), 'Pending', ?, ?, ?, ?, ?)";
        $stmt = $conn->prepare($query);

        // Käyttäjän tiedot (oletetaan kiinteä käyttäjäID, voit muokata tarpeidesi mukaan)
        $userID = 1;

        // Lasketaan tilauksen kokonaishinta
        $totalPrice = 0;
        foreach ($_SESSION["products"] as $cartItem) {
            $productID = $cartItem["productID"];
            $quantity = $cartItem["count"];

            // Hae tuotteen hinta tietokannasta
            $productQuery = "SELECT Price FROM products WHERE ProductID = ?";
            $productStmt = $conn->prepare($productQuery);
            $productStmt->bind_param("i", $productID);
            $productStmt->execute();
            $productResult = $productStmt->get_result();
            $productInfo = $productResult->fetch_assoc();

            // Laske tuotteen osuus kokonaishinnasta
            $subtotal = $productInfo["Price"] * $quantity;
            $totalPrice += $subtotal;
        }

        $stmt->bind_param("idsiss", $userID, $totalPrice, $firstname, $lastname, $email, $address);
        $stmt->execute();
        $orderID = $stmt->insert_id;
        $stmt->close();

        // Lisää tilauksen tuotteet tietokantaan
        $orderItemsQuery = "INSERT INTO orderitems (OrderID, ProductID, Quantity, Subtotal) VALUES (?, ?, ?, ?)";
        $orderItemsStmt = $conn->prepare($orderItemsQuery);

        foreach ($_SESSION["products"] as $cartItem) {
            $productID = $cartItem["productID"];
            $quantity = $cartItem["count"];

            $productQuery = "SELECT Price FROM products WHERE ProductID = ?";
            $productStmt = $conn->prepare($productQuery);
            $productStmt->bind_param("i", $productID);
            $productStmt->execute();
            $productResult = $productStmt->get_result();
            $productInfo = $productResult->fetch_assoc();

            $subtotal = $productInfo["Price"] * $quantity;

            $orderItemsStmt->bind_param("iiid", $orderID, $productID, $quantity, $subtotal);
            $orderItemsStmt->execute();
        }

        $orderItemsStmt->close();

        // Tyhjennä ostoskori
        unset($_SESSION["products"]);

        echo "<H1>Kiitos tilauksesta!</h1>";
    } else {
        echo "Ostoskori on tyhjä. Lisää tuotteita ennen tilauksen tekemistä.";
    }
} else {
    echo "Virheellinen tilauspyyntö.";
}

echo "</main>";

include 'partials/footer.php';
include 'scripts/navScript.php';
include 'partials/htmlEnd.php';
?>


<?php    
/*    
    include 'partials/doc.php';
    include 'partials/header.php';
    include 'partials/nav.php';

    echo "<main>";                                                                  
    echo "<H1>Kiitos tilauksesta!</h1>";
    echo "</main>";
    
    include 'partials/footer.php';
    include 'scripts/navScript.php';
    include 'partials/htmlEnd.php';
*/
?>
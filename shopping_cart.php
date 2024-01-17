<?php
    


    require 'includes_other/dbconn.php';
    include 'includes_other/dbsearchbar.php';
    include 'partials/doc.php';
    include 'partials/header.php';
    include 'partials/nav.php';
    
    echo "<main>";
    echo "<div class='shopping_cart_table'>";
    

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['product_id'])) {
        $product_id = filter_var($_POST['product_id'], FILTER_VALIDATE_INT);
    
        if ($product_id !== false && $product_id > 0) {
            // Hae tuotteen tiedot tietokannasta
            $product_query = "SELECT * FROM products WHERE ProductID = ?";
            $product_stmt = $conn->prepare($product_query);
            $product_stmt->bindParam(1, $product_id, PDO::PARAM_INT);
            $product_stmt->execute();
            $product_info = $product_stmt->fetch(PDO::FETCH_ASSOC);
    
            if ($product_info) {
                // Luodaan ostoskorin tuote
                $cart_item = [
                    "productID" => $product_info["ProductID"],
                    "productName" => $product_info["ProductName"],
                    "price" => $product_info["Price"],
                    "quantity" => 1, // Oletuksena 1
                    //"userID" => $loggedInUserID,
                ];
    
                // Luodaan sessioon ostoskori, jos sitä ei ole
                if (!isset($_SESSION["cart"])) {
                    $_SESSION["cart"] = [];
                }
    
                // Tarkista, onko tuote jo ostoskorissa
                $product_exists = false;
                foreach ($_SESSION["cart"] as &$existing_item) {
                    if ($existing_item["productID"] === $cart_item["productID"]) {
                        $existing_item["quantity"]++;
                        $product_exists = true;
                        break;
                    }
                }
    
                // Jos tuotetta ei löytynyt, lisää se ostoskoriin
                if (!$product_exists) {
                    $_SESSION["cart"][] = $cart_item;
                }
            }
        }
    }
    
    // Tarkista, onko nollaa ostoskori -painiketta painettu
    if (isset($_POST['reset_cart'])) {
        // Tyhjennä ostoskori
        unset($_SESSION["cart"]);
        header("Location: shopping_cart.php"); // Ohjaa takaisin ostoskorin sivulle
        exit;
    }
    
    // Tulosta ostoskori
    echo "<h1>Ostoskori</h1>";
    
    if (!empty($_SESSION["cart"])) {
        echo "<table border='1'>";
        echo "<tr> 
                <th>Tuotteen nimi</th>
                <th>Hinta</th>
                <th>Kappalemäärä</th>
            </tr>";
    
        foreach ($_SESSION["cart"] as $cart_item) {
            echo "<tr>";
            echo "<td>" . $cart_item["productName"] . "</td>";
            echo "<td>€" . $cart_item["price"] . "</td>";
            echo "<td>" . $cart_item["quantity"] . "</td>";
            echo "</tr>";
        }
    
        $total_price = array_sum(array_column($_SESSION["cart"], 'price'));
    
        echo "<tr>
                <td colspan='2'><strong>Yhteensä</strong></td>
                <td><strong>€" . number_format($total_price, 2) . "</strong></td>
            </tr>";
        echo "</table>";
?>
<form action="order_process.php" method="post">
    <input type="submit" name="place_order" value="Tilaa">
</form>
<?php
    
         // Lisää nollaa ostoskori -painike
         echo "<form method='post' action='testi_shopping_cart.php'>";
         echo "<input type='submit' name='reset_cart' value='Nollaa ostoskori'>";
         echo "</form>";
         
    } else {
        echo "Ostoskori on tyhjä.";
    }
?>
    </main>
<?php

    include 'partials/footer.php';
    include 'scripts/navScript.php';
    include 'partials/htmlEnd.php';
?>
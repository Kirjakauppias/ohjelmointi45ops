<?php

    require 'includes/dbconn.php';
    //session_unset(); // Poistetaan sessiot
    //session_destroy();
    
    $query = "SELECT * FROM products";
    $stmt = $conn->prepare($query);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    include 'includes/dbsearchbar.php';
    include 'partials/doc.php';
    include 'partials/header.php';
    include 'partials/nav.php';
    
    echo "<main>";
    echo "<div class='shopping_cart_table'>";
    

    if (isset($_GET["product_id"]) && is_numeric($_GET["product_id"])) {
        $product_id = filter_var($_GET["product_id"], FILTER_VALIDATE_INT);
    
        if ($product_id !== false && $product_id > 0) {

            // Haetaan tietokannasta suurin oleva ProductID
            $query = "SELECT MAX(ProductID) as maxProductID FROM products";
            $stmt = $conn->prepare($query);
            $stmt->execute();
            $max_result = $stmt->fetch(PDO::FETCH_ASSOC);

            // Varmistetaan ettei kirjoiteta liian isoa ProductID -numeroa
            if ($product_id <= $max_result["maxProductID"]) {

                $newShoppingCart = [
                "productID" => $product_id,
                "count" => 1, // Oletuksena 1
                ];
    
                $productExists = false;
    
                // Tarkista, onko tuote jo ostoskorissa
                if (isset($_SESSION["products"]) && count($_SESSION["products"]) > 0) {
                    foreach ($_SESSION["products"] as &$existingProduct) {
                        if ($existingProduct["productID"] === $newShoppingCart["productID"]) {
                            $existingProduct["count"]++;
                            $productExists = true;
                            break;
                        }
                    }
                }
    
                // Luodaan sessioon tyhjä, vain jos sitä ei ole
                if (!isset($_SESSION["products"])) {
                    // Luodaan tyhjä lista
                    $_SESSION["products"] = []; // Shopping cart session
                }           
    
                // Jos tuotea ei löytynyt, tallennetaan uusi tuote sessioon
                if ($productExists === false) {
                     $_SESSION["products"][] = $newShoppingCart;
                }
            } else {
                echo "Virheellinen product_id";
            }
        } else {
            echo "Virheellinen product_id";
        }
    }

    echo "<h2>Ostoskori</h2>";

    if (isset($_SESSION["products"]) && count($_SESSION["products"]) > 0) {
        echo "<table border='1'>";
        echo "<tr><th>Tuotteen nimi</th><th>Hinta</th><th>Kappalemäärä</th></tr>";
        
            foreach ($_SESSION["products"] as $cartItem) {

            //Hae tuotteen tiedot tietokannasta
            $query = "SELECT * FROM products WHERE ProductID = :productID";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(":productID", $cartItem["productID"]);
            $stmt->execute();
            $productInfo = $stmt->fetch(PDO::FETCH_ASSOC);
    
            echo "<tr>";
            echo "<td>" . $productInfo["ProductName"] . "</td>";
            echo "<td>€" . $productInfo["Price"] . "</td>";
            echo "<td>" . $cartItem["count"] . "</td>";
            echo "</tr>";
        }
    
        echo "</table>";
    } else {
        echo "Ostoskori on tyhjä.";
    }

echo "</div>";
echo "</main>";

    include 'partials/footer.php';
    include 'scripts/navScript.php';
    include 'partials/htmlEnd.php';
?>


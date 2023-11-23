<?php

    require 'includes/dbconn.php';
    
    $query = "SELECT * FROM products";
    $stmt = $conn->prepare($query);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    include 'includes/dbsearchbar.php';
    include 'partials/doc.php';
    include 'partials/header.php';
    include 'partials/nav.php';
    
    echo "<main>";
    

    if (isset($_GET["product_id"])) {
        $product_id = filter_var($_GET["product_id"], FILTER_VALIDATE_INT);
    
        if ($product_id !== false && $product_id > 0) {
    
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
    
        }
    }

       echo "<h2>Ostoskori</h2>";

    if (isset($_SESSION["products"]) && count($_SESSION["products"]) > 0) {
        print_r($_SESSION["products"]);
    } else {
        echo "Ostoskori on tyhjä.";
    }


echo "</main>";

    include 'partials/footer.php';
    include 'scripts/navScript.php';
    include 'partials/htmlEnd.php';
?>


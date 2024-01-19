<?php
    
    require_once 'includes_other/dbconn.php';
    require_once 'includes_other/dbenquiry.php';
    require_once 'loops/product_model.php';
    include 'includes_other/dbsearchbar.php';
    include 'includeFunctions.php';
    includeUpperElements();

    echo "<main>";
        echo "<div class='shopping_cart_table'>";
            //Tarkistetaan että käyttäjä on painanut tuotteen ostoskoria.
            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['product_id'])) {
                $product_id = filter_var($_POST['product_id'], FILTER_VALIDATE_INT);
                
                //Varmistetaan että muuttujan arvo on positiivinen kokonaisluku. 
                if ($product_id !== false && $product_id > 0) {
                    //Funktio tuotetietojen hakemiseen.
                    $product_info = getProductToCart($conn, $product_id); 
                    
                    //Jos tuotetiedot on haettu tietokannasta.
                    if ($product_info) {
                        //Funktio ostoskorin tuotteen luomiseen.
                        $cart_item = createCartItem($product_info);
                
                            //Luodaan sessioon ostoskori, jos sitä ei ole
                            //Luodaan väliaikainen $_SESSION["cart"]
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
            //Tulostetaan ostoskori
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
            echo "<form method='post' action='shopping_cart.php'>";
            echo "<input type='submit' name='reset_cart' value='Nollaa ostoskori'>";
            echo "</form>";
        } else {
            echo "Ostoskori on tyhjä.";
        }

        //Tarkista, onko nollaa ostoskori -painiketta painettu
        if (isset($_POST['reset_cart'])) {
            //Tyhjennä ostoskori.
            //Poistetaan väliaikainen $_SESSION["cart"].
            unset($_SESSION["cart"]);
            header("Location: shopping_cart.php"); // Ohjaa takaisin ostoskorin sivulle
            exit();
        }
?>
</main>
<?php
    include 'partials/footer.php';
    include 'scripts/navScript.php';
    include 'partials/htmlEnd.php';
?>
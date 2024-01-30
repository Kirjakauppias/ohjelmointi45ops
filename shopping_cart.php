<?php
require_once 'includes/db_connection.inc.php';
require_once 'includes/db_enquiry.inc.php';
require_once 'includes/product_model.inc.php';
require_once 'includes/product_functions.inc.php';
include 'functions_partials.php';
includeUpperElements();
echo "<div class='shopping-cart-container'>";
echo "<div class='shopping_cart_table'>";

//Tarkistetaan, onko käyttäjä kirjautunut sisään:
if (isset($_SESSION["from_login_page"]) && isset($_SESSION['user_username']) ) {
    
    // Haetaan käyttäjän tiedot tietokannasta
    $userID = $_SESSION['user_id'];
    $userDetails = getUserDetails($pdo_conn, $userID);
}

//Tarkistetaan että käyttäjä on painanut tuotteen ostoskoria.
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['product_id'])) {
    $product_id = filter_var($_POST['product_id'], FILTER_VALIDATE_INT);
    
    //Varmistetaan että muuttujan arvo on positiivinen kokonaisluku. 
    if ($product_id !== false && $product_id > 0) {
        //Funktio tuotetietojen hakemiseen.
        $product_info = getProductToCart($pdo_conn, $product_id); 
        
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
    //Jos otoskori on olemassa.
    if (!empty($_SESSION["cart"])) {
        echo "<table class='cart-table'>";
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
        //Haetaan kaikki 'price' -avaimen arvot $_SESSION["cart"] -taulukosta.
        $total_price = array_sum(array_column($_SESSION["cart"], 'price'));
        //number_format(numero, desimaalien määrä) 
        echo "<tr>
        <td colspan='2'><strong>Yhteensä</strong></td>
        <td><strong>€" . number_format($total_price, 2) . "</strong></td> 
        </tr>";
        echo "</table>";

        // Lisää nollaa ostoskori -painike
        echo "<form method='post' action='shopping_cart.php' class='reset-cart-form'>";
            echo "<button type='submit' name='reset_cart'>Nollaa ostoskori</button>";
        echo "</form>";
        echo "</div>";
        echo "<div class='user-order-info-wrap'>";

        //Lomake jossa siirrytään viimeistelemään tilaus.
        echo "<h2>Yhteystiedot</h2>";
        echo "<form action='order_page.php' method='post' class='customer-info-form'>";
            echo "<label for='firstname'>Etunimi:</label><br>";
            echo "<input type='text' name='firstname'  value='" . htmlspecialchars($userDetails['FirstName'] ?? '') . "' required><br>";
            echo "<label for='lastname'>Sukunimi:</label><br>";
            echo "<input type='text' name='lastname' value='" . htmlspecialchars($userDetails['LastName'] ?? '') . "' required><br>";
            echo "<label for='email'>Sähköposti:</label><br>";
            echo "<input type='email' name='email'value='" . htmlspecialchars($userDetails['Email'] ?? '') . "' required><br>";
            echo "<label for='address'>Osoite:</label><br>";
            echo "<input type='text' name='address' value='" . htmlspecialchars($userDetails['Address'] ?? '') . "' required><br>";
            echo "<button type='submit' name='finalize_order'>Viimeistele tilaus</button>";
        echo "</form>";
        echo "</div>";
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

echo "</div>";
echo "</div>";
   



includeBottomElements();

/*Session testauskoodi.
echo "<pre>";
var_dump($_SESSION);
echo "</pre>";*/
?>
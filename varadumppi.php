<div class="login-signup-container">
    <div class="login-form">
        <?php output_username(); ?>

        <?php
        if(!isset($_SESSION["user_id"])) {?>
            <h3>Kirjautuminen</h3>

            <form action="includes/login.inc.php" method="post">
                <input type="text" name="username" placeholder="Käyttäjätunnus"><br>
                <input type="password" name="password" placeholder="Salasana"><br>
                <button>Kirjaudu sisään</button>
            </form>

        <?php } ?>

        <?php
        
            check_login_errors();
        ?>
    </div>
    
    //ONGELMA: Sivua kun päivittää, viimeisin tuoteen määrä lisääntyy yhdellä.

    // Tarkista, onko from_member_area-parametri asetettu
    $fromMemberArea = isset($_GET['from_member_area']) && $_GET['from_member_area'] === 'true';

    // Poista istunnon arvo, jotta se ei vaikuta tuleviin sivulatauksiin
    unset($_SESSION['from_member_area']);

    


    require 'includes_other/dbconn.php';
    //session_unset(); // Poistetaan sessiot
    //session_destroy();
    
    $query = "SELECT * FROM products";
    $stmt = $conn->prepare($query);
    $stmt->execute();

    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    include 'includes_other/dbsearchbar.php';
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
            echo "<tr> 
                    <th>Tuotteen nimi</th>
                    <th>Hinta</th>
                    <th>Kappalemäärä</th>
                </tr>";
        
                foreach ($_SESSION["products"] as $cartItem) {

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

            $totalPrice = 0;

        foreach ($_SESSION["products"] as $cartItem) {
    $query = "SELECT * FROM products WHERE ProductID = :productID";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(":productID", $cartItem["productID"]);
    $stmt->execute();
    $productInfo = $stmt->fetch(PDO::FETCH_ASSOC);

    $subtotal = $cartItem["count"] * $productInfo["Price"];
    $totalPrice += $subtotal;
}
            echo "<tr>
                    <td colspan='2'><strong>Yhteensä</strong></td>
                    <td><strong>€" . number_format($totalPrice, 2) . "</strong></td>
                </tr>";
        echo "</table>";
    } else {
        echo "Ostoskori on tyhjä.";
    }

    echo "</div>";

    echo "<form method='post' action=''>";
        echo "<input type='submit' name='reset_cart' value='Nollaa ostoskori'>";
    echo "</form>";

// Nollaa ostoskori jos lomaketta on painettu
if (isset($_POST['reset_cart'])) {
    session_destroy();
    header("Location: shopping_cart.php");
} 

?>
<div class="register-form-container">
<form action="order_delivered.php" method="post">
        <!-- Näytä ostoskorin tiedot (tuotteiden nimet, hinnat, kappalemäärät jne.) -->
        <?php
        if (!empty($_SESSION["products"])) {
            foreach ($_SESSION["products"] as $cartItem) {
                echo "<input type='hidden' name='product_ids[]' value='" . $cartItem["productID"] . "'>";
                echo "<input type='hidden' name='quantities[]' value='" . $cartItem["count"] . "'>";
            }
        } 
        ?>
        
        <!-- Toimitustiedot -->
        <input type="text" name="firstname" placeholder="Etunimi" required><br>
        <input type="text" name="lastname" placeholder="Sukunimi" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="text" name="address" placeholder="Osoite" required><br>
        
        <!-- Lähetä tilaus-painike -->
        <input type="submit" value="Lähetä tilaus">
    </form>
        </div>
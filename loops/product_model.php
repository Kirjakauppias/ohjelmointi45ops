<?php
//Funktio, joka tulostaa käyttäjälle yhden tuotteen
function printProduct($rivi) {
    echo "<div class='product-container'>";
        echo "<h3>" . $rivi["ProductName"] . "</h3>"; //Tuotteen nimi
        echo "<a href='product_display.php?ProductID=" . $rivi["ProductID"] . "'><img src='product_images/" . $rivi["ImageURL"] . "'></a>"; //Tuotteen kuvasta klikataan 1 tuotteen sivulle
            echo "<div class='product-price-cart-container'>";
            echo "<p>€ " . $rivi["Price"] . "</p>";

                //Luodaan formi josta voidaan klikata tuote ostoskoriin: method=POST name='product_id'
                //Nappia painamalla siirrytään ostoskori-sivulle.
                //TEHTÄVÄ: käyttäjän pitäisi jäädä sivulle mistä tuotteen valitsi. KUINKA?
                echo "<form action='shopping_cart.php' method='post'>";
                    echo "<input type='hidden' name='product_id' value='{$rivi["ProductID"]}'>";
                    echo "<button type='submit'><img src='images/cart_small.png' alt='Lisää ostoskoriin'></button>";
                echo "</form>";
            echo "</div>";
    echo "</div>";
}

//Tämä funktio on product_display.php -sivulle
function printOneProduct($product){
    echo "<div class='product-display-main'>";                                                                  
                echo "<div class='product-display-container'>";
                    echo "<div class='product-display-image'>";
                        echo "<img src=product_images/". $product["ImageURL"] .">";
                    echo "</div>";
                    echo "<div class='product-display-detail'>";
                        echo "<h2>" . $product["ProductName"] . "</h2>";
                        echo "<p>" . $product["Description"] . "</p>";
                        echo "<p>Hinta: €" . $product["Price"] . "</p>";
                        echo "<br><br>";
                        echo "<form action='shopping_cart.php' method='post'>";
                            echo "<input type='hidden' name='product_id' value='$product[ProductID]'>";
                            echo "<button type='submit'>Lisää ostoskoriin</button>";
                    echo "</form>";
                    echo "</div>";
                echo "</div>";
    echo "</div>";
    }

//Funktio joka tulostaa tuotteen $_GET['ProductID'] -perusteella
function displayGetProduct($conn){
    // Tarkistetaan, onko ProductID asetettu URL-parametreihin
    if (isset($_GET['ProductID'])){
        $productID = $_GET['ProductID'];    //Haetaan URL:stä oleva ProductID muuttujaan
        $product = getProductByID($conn, $productID);

            // Tarkistetaan, että $product on taulukko ja että sillä on odotetut indeksit ennen tulostusta
            if (is_array($product) && isset($product['ProductName'])) {
                printOneProduct($product); // Funktio tulostaa tuotteen jossa muuttujana on $_GET['ProductID'];
            } else {
                echo "Tuotetta ei löytynyt!";
            }
    } else {
        echo "Tuotetta ei löytynyt!";
    }
}

//Funktio joka luo tuotteen ostoskoriin
function createCartItem($productInfo) {
    return [
        "productID" => $productInfo["ProductID"],
        "productName" => $productInfo["ProductName"],
        "price" => $productInfo["Price"],
        "quantity" => 1, //Oletuksena 1
        //"userID" => $loggedInUserID,
    ];
}

function printSearchedProducts($products) {
    if (empty($products)) {
        echo "Tuotteita ei löytynyt!";
    } else {
        foreach ($products as $rivi) {
            printProduct($rivi);
        }
    }
}
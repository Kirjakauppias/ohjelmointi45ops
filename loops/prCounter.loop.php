<?php
//TÄMÄ SIVU NÄYTTÄÄ 6 TUOTETTA SATUNNAISESSA JÄRJESTYKESSSÄ

$laskuri = 0;
$randomProducts = getRandomProducts($conn); //Tietokantahaku-funktio

foreach ($randomProducts as $rivi) {
    if ($laskuri >= 6) {
        break;
    }
        echo "<div class='product-container'>";
            echo "<h3>" . $rivi["ProductName"] . "</h3>";       
            echo "<a href='product_display.php?ProductID=" . $rivi["ProductID"]. "'><img src=product_images/". $rivi["ImageURL"] . "></a>"; //Tuotteen kuvasta klikataan 1 tuotteen sivulle
                echo "<div class='product-price-cart-container'>";
                    echo "<p>€ " . $rivi["Price"] . "</p>";

                    //Luodaan formi josta voidaan klikata tuote ostoskoriin: method=POST name='product_id'
                    //Nappia painamalla siirrytään ostoskori-sivulle.
                    //TEHTÄVÄ: käyttäjän pitäisi jäädä sivulle mistä tuotteen valitsi. KUINKA?
                    echo "<form action='shopping_cart.php' method='post'>";
                        echo "<input type='hidden' name='product_id' value='$rivi[ProductID]'>";
                        echo "<button type='submit'><img src='images/cart_small.png' alt='Lisää ostoskoriin'></button>";
                    echo "</form>";

                echo "</div>";
        echo "</div>";
    $laskuri++;
}



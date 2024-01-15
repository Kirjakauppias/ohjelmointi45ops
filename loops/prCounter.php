<?php
//Looppi joka näyttää 6 tuotetta
$laskuri = 0;
        while($rivi = $random_stmt->fetch()) {
            if ($laskuri >= 6) {
                break;
            }
            echo "<div class='product-container'>";
                echo "<h3>" . $rivi["ProductName"] . "</h3>";       //Tuotteen nimi
                echo "<a href='product_display.php?ProductID=" . $rivi["ProductID"]. "'><img src=product_images/". $rivi["ImageURL"] . "></a>"; //Tuotteen kuvasta klikataan 1 tuotteen sivulle
                echo "<div class='product-price-cart-container'>";
                    echo "<p>€ " . $rivi["Price"] . "</p>";

                    echo "<form action='shopping_cart.php' method='get'>";
                        echo "<input type='hidden' name='product_id' value='$rivi[ProductID]'>";
                        echo "<button type='submit'><img src='images/cart_small.png' alt='Lisää ostoskoriin'></button>";
                    echo "</form>";
                echo "</div>";
            echo "</div>";
            $laskuri++;
        }

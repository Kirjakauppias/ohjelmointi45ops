<?php
            while($rivi = $products_kysely->fetch()) {
                echo "<div class='product-container'>";
                echo "<h3>" . $rivi["ProductName"] . "</h3>";       //Tuotteen nimi
                echo "<a href='product_display.php?ProductID=" . $rivi["ProductID"]. "'><img src=product_images/". $rivi["ImageURL"] . "></a>"; //Tuotteen kuvasta klikataan 1 tuotteen sivulle
                echo "<div class='product-price-cart-container'>";
                    echo "<p>€ " . $rivi["Price"] . "</p>";

                    echo "<form action='shopping_cart.php' method='post'>";
                        echo "<input type='hidden' name='product_id' value='$rivi[ProductID]'>";
                        echo "<button type='submit'><img src='images/cart_small.png' alt='Lisää ostoskoriin'></button>";
                    echo "</form>";
                echo "</div>";
                echo "</div>";
            }
?>
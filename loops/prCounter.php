<?php
//Looppi joka näyttää 6 tuotetta
$laskuri = 0;
        while($rivi = $products_kysely->fetch()) {
            if ($laskuri >= 6) {
                break;
            }
            echo "<div class='product-container'>";
                echo "<h3>" . $rivi["ProductName"] . "</h3>";
                echo "<a href='product_display.php?ProductID=" . $rivi["ProductID"]. "'><img src=product_images/". $rivi["ImageURL"] . "></a>";
                echo "<div class='product-price-cart-container'>";
                echo "<p>€ " . $rivi["Price"] . "</p>" . "<a href=''><img src='images/cart_small.png'>";
                echo "</div>";
            echo "</div>";
            $laskuri++;
        }
?>
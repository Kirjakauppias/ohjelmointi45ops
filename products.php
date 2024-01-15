<?php
    require 'includes_other/dbconn.php';
    require 'includes_other/dbenquiry.php';
    include 'includes_other/dbsearchbar.php';

    include 'partials/doc.php';
    include 'partials/header.php';
    include 'partials/nav.php';
?>
    <div class="index-main">                                                                  
    <?php
            while($rivi = $products_kysely->fetch()) {
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
            }
        ?>
    </div>

<?php
    include 'partials/footer.php';
    include 'scripts/navScript.php';
    include 'partials/htmlEnd.php';
?>

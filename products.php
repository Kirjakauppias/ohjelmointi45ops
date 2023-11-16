<?php
    require 'includes/dbconn.php';
    require 'includes/dbenquiry.php';
    include 'includes/dbsearchbar.php';

    include 'partials/doc.php';
    include 'partials/header.php';
    include 'partials/nav.php';
?>
    <div class="index-main">                                                                  
    <?php
            while($rivi = $products_kysely->fetch()) {
                echo "<div class='product-container'>";
                    echo "<h3>" . $rivi["ProductName"] . "</h3>";
                    echo "<a href='product_display.php?ProductID=" . $rivi["ProductID"]. "'><img src=product_images/". $rivi["ImageURL"] . "></a>";
                    echo "<div class='product-price-cart-container'>";
                        echo "<p>€ " . $rivi["Price"] . "</p>" . "<a href=''><img src='images/cart_small.png'>";
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
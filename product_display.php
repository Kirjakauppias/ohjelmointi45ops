<?php
    //HOX!! TÄMÄ EI OLE VIELÄ VALMIS, VIRHE-ILMOITUKSEN MUOTOILU KESKEN!!

    require 'includes_other/dbconn.php';
    // Tarkistetaan, onko ProductID asetettu URL-parametreihin
    if (isset($_GET['ProductID'])){
        $productID = $_GET['ProductID'];    //Haetaan URL:stä oleva ProductID muuttujaan
        require 'includes_other/dbenquiry.php';
    } else {
            $noproduct = true;  //URL:ssä ei ollut ProductID:tä joten siitä virheilmoitus
        }
    
    include 'includes_other/dbsearchbar.php';
    include 'partials/doc.php';
    include 'partials/header.php';
    include 'partials/nav.php';

    echo "<main>";
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
    echo "</main>";

    include 'partials/footer.php';
    include 'scripts/navScript.php';
    include 'partials/htmlEnd.php';

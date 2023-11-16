<?php
    //HOX!! TÄMÄ EI OLE VIELÄ VALMIS, VIRHE-ILMOITUKSEN MUOTOILU KESKEN!!

    require 'includes/dbconn.php';
    // Tarkistetaan, onko ProductID asetettu URL-parametreihin
    if (isset($_GET['ProductID'])){
        $productID = $_GET['ProductID'];    //Haetaan URL:stä oleva ProductID muuttujaan
        require 'includes/dbenquiry.php';
    } else {
            $noproduct = true;  //URL:ssä ei ollut ProductID:tä joten siitä virheilmoitus
        }
    
    include 'includes/dbsearchbar.php';
    include 'partials/doc.php';
    include 'partials/header.php';
    include 'partials/nav.php';

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
                        echo "<a href=''><p class='product-cart-text'>Lisää ostoskoriin</p></a>";
                    echo "</div>";
                echo "</div>";
    echo "</div>";

    include 'partials/footer.php';
    include 'scripts/navScript.php';
    include 'partials/htmlEnd.php';
?>
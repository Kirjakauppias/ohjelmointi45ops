<?php
    require_once 'includes/config_session.inc.php';
    require_once 'includes/signup_view.inc.php';
    require_once 'includes/login_view.inc.php';

    // Tietokanta yhteys
    // Palvelimen nimi muuttujaan
    $servername = "localhost";
    $databasename = "verkkokauppa";
    $username = "root";
    $password = "";
    
    //Yritetään
    try {
        //Luodaan yhteys, joka on PDO objekti
        $conn = new PDO("mysql:host=$servername;dbname=$databasename", $username, $password);
        
        //PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }
    catch (PDOException $e) {
        // Yhteys epäonnistui
        echo "". $e->getMessage();
    }
    
    //Haetaan tuotteita randomilla
    //Index-sivulla
    $random_products_kysely = ("SELECT * FROM products ORDER BY RAND()");
    $random_stmt = $conn->prepare($random_products_kysely);
    $random_stmt->execute();
    
    include 'includes_other/dbsearchbar.php';
    
    include 'partials/doc.php';
    include 'partials/header.php';
    include 'partials/nav.php';
    
    echo "<main>";


?>

    
<?php
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
        
        echo "<form action='testi_shopping_cart.php' method='post'>";
        echo "<input type='hidden' name='product_id' value='$rivi[ProductID]'>";
        echo "<button type='submit'><img src='images/cart_small.png' alt='Lisää ostoskoriin'></button>";
        echo "</form>";
        echo "</div>";
        echo "</div>";
        $laskuri++;
    }
?>
   
<?php
    echo "</main>";
    include 'partials/footer.php';
    include 'scripts/navScript.php';
    include 'partials/htmlEnd.php';
?>
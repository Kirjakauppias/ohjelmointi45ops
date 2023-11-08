<?php
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

        $products_kysely = $conn->prepare("SELECT * FROM products"   );

        $products_kysely->execute();
    }
    catch (PDOException $e) {
        // Yhteys epäonnistui
        echo "". $e->getMessage();
    }
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KIRJA-SOPPI - ETUSIVU</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <header>
        <!--BANNERI & SEARCH-->
        <div class="banner-search-container">
            <!--BANNERI-->
            <div class="banner">
                <h1>TUOTE-SOPPI</h1>
            </div>
        
            <!--SEARCHBAR-->
            <div class="search-container">
                <input type="text" placeholder="Etsi tuotteita">
                <button>Etsi</button>
            </div>
        </div>
        
        <!--MENU & KIRJAUTUMINEN & OSTOSKORI-->
        <div class="menu-log-cart-container">
            <div class="menu">
                <a href=""><img src="images/menutext.png"></a>
            </div>
            <div class="log">
                <a href="login.php"><img src="images/logtext.png"></a>
            </div>
            <div class="cart">
                <a href=""><img src="images/carttext.png"></a>
            </div>
        </div>
    </header>

    <!--TUOTTEITA KUUSI KAPPALETTA, EI VIELÄ RANDOMILLA-->
    <div class="index-main">                                                                  
    <?php
            $laskuri = 0;
            while($rivi = $products_kysely->fetch()) {
                if ($laskuri >= 6) {
                    break;
                }
                echo "<div class='product-container'>";
                    echo "<h3>" . $rivi["ProductName"] . "</h3>";
                    echo "<img src=product_images/". $rivi["ImageURL"] . ">";
                    echo "<p>" . $rivi["Price"] . "</p>";
                echo "</div>";
                $laskuri++;
            }
        ?>
    </div>
    <footer>
    </footer>
</body>
</html>
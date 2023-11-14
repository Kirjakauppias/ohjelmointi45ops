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
                <img src="images/banner_small.png">
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
                <img src="images/menutext.png" class="log"> <!--Luotu luokka "log" javascriptia varten-->
            </div>
            <div class="log">
                <a href="login.php"><img src="images/logtext.png"></a>
            </div>
            <div class="cart">
                <a href=""><img src="images/carttext.png"></a>
            </div>
        </div>
    </header>
    
    <!--NAVIGOINTI-->
    <nav>
        <div class="frontpage-link">
            <a href="index.php">ETUSIVU</a>
        </div>
        <div class="all-products-link">
            <a href="products.php">KAIKKI TUOTTEET</a>
        </div>
    </nav>

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
                    echo "<a href='product_display.php?ProductID=" . $rivi["ProductID"]. "'><img src=product_images/". $rivi["ImageURL"] . "></a>";
                    echo "<div class='product-price-cart-container'>";
                    echo "<p>€ " . $rivi["Price"] . "</p>" . "<img src='images/cart_small.png'>";
                    echo "</div>";
                echo "</div>";
                $laskuri++;
            }
        ?>
    </div>

    <!--FOOTER -OSIO-->
    <footer>
        <div class="footer-header-body-container">
            <div class="footer-osoitetiedot">
                <h4>YHTEYSTIEDOT</h4>
                <ol>
                    <li>Yritystie 1 a 2</li>
                    <li>70100 Kuopio</li>
                </ol>
            </div>
            <div class="asiakaspalvelu">
                <h4>ASIAKASPALVELU</h4>
                    <ol>
                        <li>Asiakaspalvelu</li>
                        <li>Ota yhteyttä</li>
                        <li>Usein kysyttyä</li>
                        <li>Maksutavat</li>
                    </ol>
            </div>
            <div class="footer-avainlogo">
                <img src="images/avain.png">
            </div>
        <div>
    </footer>


    <!--TÄMÄ SCRIPTI ON CHATgpt:N KAUTTA-->
    <!--KOODI TUO ESIIN NAVIGOINTIPALKIN KUN PAINAA "AVAA VALIKKO -KUVAA-->        
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const nav = document.querySelector('nav');
            const logButton = document.querySelector('.log');

            logButton.addEventListener('click', function() {
                if (nav.style.display === 'none' || nav.style.display === '') {
                    nav.style.display = 'flex';
                } else {
                    nav.style.display = 'none';
                }
            });
        });
    </script>

</body>
</html>
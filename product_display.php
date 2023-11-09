<?php
    // Tarkistetaan, onko ProductID asetettu URL-parametreihin
   // if (isset($_GET['ProductID'])){

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

        $productID = $_GET['ProductID'];    //Haetaan URL:stä oleva ProductID muuttujaan
        $products_kysely = $conn->prepare("SELECT * FROM products WHERE ProductID = :productID");
        $products_kysely->bindParam(':productID', $productID);
        $products_kysely->execute();

        $product = $products_kysely->fetch();
    }
    catch (PDOException $e) {
        // Yhteys epäonnistui
        echo "". $e->getMessage();
    }
//} echo "<p>Tuotetta ei löytynyt!</p>";  //URL:ssä ei ollut ProductID:tä joten siitä virheilmoitus
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

    <div class="index-main">                                                                  
    <?php
                echo "<div class='product-display-container'>";
                echo "<div class='product-display-image'>";
                    echo "<img src=product_images/". $product["ImageURL"] .">";
                echo "</div>";
                echo "<div class='product-display-detail'>";
                    echo "<h2>" . $product["ProductName"] . "</h2>";
                    echo "<p>" . $product["Description"] . "</p>";
                    echo "<p>Hinta: €" . $product["Price"] . "</p>";
                echo "</div>";
                echo "</div>";
    ?>
    </div>
    <footer>
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
<?php
    session_start();

        // Tarkistetaan, onko painiketta painettu
        if(isset($_POST['logout'])) {
            // Poistetaan käyttäjän istunto
            session_destroy();
            // Ohjataan käyttäjä takaisin index.php-sivulle
            header("Location: index.php");
            exit();
        }
        
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MEMBER AREA</title>
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
        
        <!--MENU & KIRJAUTUMINEN ULOS & OSTOSKORI-->
        <div class="menu-log-cart-container">
            <div class="menu">
                <a href=""><img src="images/menutext.png"></a>
            </div>
            <div class="logout">
                <form method="post" class="logout-button">
                    <button type="submit" name="logout">
                        <img src="images/logout.png">
                    </button>
                </form>
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
    
</body>
</html>
<!-- <div>
        <form method="post" class="logout-button">
            <input type="submit" name="logout" value="Kirjaudu ulos">
        </form>
    </div> -->
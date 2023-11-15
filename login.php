<?php
   session_start();
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KIRJAUTUMIS-SIVU</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
    <?php
        //Tarkistetaan, onko käyttäjä jo kirjautunut
        if(isset($_SESSION["username"])) {
            //Siirretään käyttäjä memberArea-sivulle
            header("Location: memberArea.php");
    } 
    ?>

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
                <a href="shopping_cart.php"><img src="images/carttext.png"></a>
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

    <div class="login-main">
        
        <!--KIRJAUTUMISLOMAKE-->
        <div class="login-container">
            <h2>KIRJAUTUMINEN</h2>

            <form action="checkLogin.php" method="post">
                <div class="username"> 
                    <input type="text" name="username" placeholder="Kirjoita sähköposti">
                </div>
                <div class="password">
                    <input type="password" name="password" placeholder="Kirjoita salasana">
                </div>
                <div class="submit">
                    <input type="submit" value="Kirjaudu">
                </div>
                <div class="error-message">
                    <?php
                        if(isset($_GET["error"])) {  // Tarkistetaan onko avain (muuttuja) olemassa, ennen kuin sitä käytetään.
                            if($_GET["error"] == "login") { // Saadaan virhe, jos "error"-avain ei ole olemassa
                                echo "<p>Käyttäjätunnus ja salasana eivät täsmää!</p>";
                            }
                        }
                    ?>
                </div>
            </form>
        </div>

        <!--REKISTERÖINTI-OHJEISTUS-->
        <div class="register-container">
            <h2>OLETKO UUSI ASIAKAS?</h2>
            <a href="register.php">Rekisteröidy tästä</a>
        </div>
    </div>
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
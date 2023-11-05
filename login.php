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
    } else {
                // Kirjoitetaan virhe ilmoitus, jos kirjautumisessa oli virhe
                if(isset($_GET["error"])) {  // Tarkistetaan onko avain (muuttuja) olemassa, ennen kuin sitä käytetään.
                    if($_GET["error"] == "login") { // Saadaan virhe, jos "error"-avain ei ole olemassa
                        echo "<p>Käyttäjätunnus ja salasana eivät täsmää!</p>";
                    }
                }
    }
    ?>
    <header>
        <!--BANNERI & SEARCH-->
        <div class="banner-search-container">
            <!--BANNERI-->
            <div class="banner">
                <h1>KIRJA-SOPPI</h1>
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
                <a href=""><img src="images/logtext.png"></a>
            </div>
            <div class="cart">
                <a href=""><img src="images/carttext.png"></a>
            </div>
        </div>
    </header>
    <div class="login-main">
        
        <!--KIRJAUTUMISLOMAKE-->
        <div class="login-container">
            <h2>KIRJAUTUMINEN</h2>

            <form action="checkLogin.php" method="post"> 
                    <input type="text" name="username" placeholder="Kirjoita käyttäjätunnus">
                    <input type="password" name="password" placeholder="Kirjoita salasana">
                    <input type="submit" value="Kirjaudu">
            </form>
        </div>

        <!--REKISTERÖINTI-OHJEISTUS-->
        <div class="register-container">
            <h2>OLETKO UUSI ASIAKAS?</h2>
            <a href="">Rekisteröidy tästä</a>
        </div>
    </div>
    <footer>
    </footer>
</body>
</html>
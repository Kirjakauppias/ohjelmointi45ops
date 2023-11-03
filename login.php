<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST['email'];
        $password = $_POST['password'];

        // Vaihda oikeat sähköposti ja salasana tarpeen mukaan
        if ($email === 'metarktis@gmail.com' && $password === 'salasana123') {
            echo 'Kirjautuminen onnistui!';
        } else {
            echo 'Virheellinen sähköposti tai salasana.';
        }
    }
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KIRJAUTUMIS-SIVU</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>
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
            <p>Sisään voit kirjautua antamalla<br> 
            sähköpostiosoitteesi ja rekisteröinnin<br> 
            yhteydessä keksimäsi salasanan.</p>

            <form action="login.php" method="post"> <!--POST vai GET-->
                <div class="email">
                    <label for="email">Sähköposti:</label><br>
                    <input type="email" id="email" name="email" required><br><br>
                </div>
                <div class="password">
                    <label for="password">Salasana:</label><br>
                    <input type="password" id="password" name="password" required><br><br>
                </div>
                <div class="submit">
                    <input type="submit" value="Kirjaudu">
                </div>
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
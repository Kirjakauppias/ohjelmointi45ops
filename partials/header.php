<?php
//TÄMÄ TIEDOSTO ON PROJEKTIN OTSIKKO-TASOA VARTEN.
//session_start();
require_once 'includes/config_session.inc.php';
require_once 'includes/login_view.inc.php';
?>
<header>
    <div class="bmc-wrap">
        <!--BANNERI & SEARCH-->
        <div class="banner-searchbar-container">
            <!--BANNERI-->
            <a href="index.php" alt="Etusivu"><img src="images/banner_small.png"></a>
            
            <!--SEARCHBAR-->
            <!--Luodaan search-bar lomake-->
            <form method="get" class="searchbar-form">
                <input type="text" name="search" value="<?= htmlspecialchars($_GET['search'] ?? '') ?>" placeholder="Etsi tuotteita">
                <button type="submit">Etsi</button>
            </form>
            <form action="register.php" class="new-customer">
                <button>Uusi asiakas?</button>
            </form>
        </div>


        <!--MENU & OSTOSKORI-->
        <div class="menu-cart-container">
            <!--MENU-->    
            <img src="images/menutext.png" class="log"> <!--Luotu luokka "log" javascriptia varten-->
            <!--OSTOSKORI-->
            <a href="shopping_cart.php"><img src="images/carttext.png" class="cart-image"></a>
        </div>
    </div>

    <!--LOGIN-->
    <div class="login-container">
        <?php
        //Varmistetaan että käyttäjä on kirjautunut sisään.
        if (!isset($_SESSION["from_login_page"]) && !isset($_SESSION['user_username'])) {
            ?>
            <form action="includes/login.inc.php" method="post" class="login-form">
                    <input type="text" name="username" placeholder="Käyttäjätunnus"><br>
                    <input type="password" name="password" placeholder="Salasana"><br>
                    <div class="button-errors-wrap">
                        <button>Kirjaudu</button>
                        <div class="error-message-wrap">
                            <?php check_login_errors(); ?>
                        </div>
                    </div>
                </form>
            <?php    
        } else { 
            // Käyttäjä on kirjautunut sisään, voit näyttää kirjautuneen käyttäjän tiedot tai tehdä muita toimintoja
            echo "<h3>Tervetuloa, " . $_SESSION['user_username'] . "!</h3>";?>

            <!-- Add a log-out button -->
            <form action="includes/logout.inc.php" method="post" class="logout-form">
                <button type="submit" name="logout">Kirjaudu ulos</button>
            </form> <?php
        }?>
    </div>
</header>
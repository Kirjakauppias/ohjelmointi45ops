<?php
    session_start();
    //Nämä kutsut ovat sisäänkirjautmista varten
     require_once 'includes/signup_view.inc.php';
     require_once 'includes/login_view.inc.php';
     
?>

<header>
        <!--BANNERI & SEARCH-->
        <div class="banner-search-container">
            <!--BANNERI-->
            <div class="banner">
                <!--HOX Muutos tehty testiä varten (ennen index.php)-->
                <a href="index.php" alt="Etusivu">
                    <img src="images/banner_small.png">
                </a>
            </div>
        
            <!--SEARCHBAR-->
            <div class="search-container">
                <form action="index.php" method="get">
                    <input type="text" name="search" placeholder="Etsi tuotteita">
                    <button type="submit">
                        Etsi
                    </button>
                </form>
            </div>
        </div>
        
        <!--MENU & KIRJAUTUMINEN & OSTOSKORI-->
        <div class="menu-log-cart-container">
            <div class="menu">
                <img src="images/menutext.png" class="log"> <!--Luotu luokka "log" javascriptia varten-->
            </div>
            
            <div class="cart">
                <a href="shopping_cart.php"><img src="images/carttext.png"></a>
            </div>

            <div>
                <?php
                //output_username();
                if (!isset($_SESSION["from_login_page"])) {
                    ?>

                        <form action="includes/login.inc.php" method="post">
                            <input type="text" name="username" placeholder="Käyttäjätunnus"><br>
                            <input type="password" name="password" placeholder="Salasana"><br>
                            <button>Log in</button>
                        </form>
                <?php 

                check_login_errors();
                } else { 
                    if (isset($_SESSION["from_login_page"]) && isset($_SESSION['user_username']) ){
                    // Käyttäjä on kirjautunut sisään, voit näyttää kirjautuneen käyttäjän tiedot tai tehdä muita toimintoja
                    $username = $_SESSION["username"];
                    echo "Tervetuloa, " . $username . "!"; ?>

                    <!-- Add a log-out button -->
                    <form action="includes/logout.inc.php" method="post">
                        <button type="submit" name="logout">Kirjaudu ulos</button>
                    </form>
                    <?php
                    }
                            
                }
                ?>

            </div>
        </div>


        
</header>
<?php
    session_start();

    // Tarkistetaan, onko käyttäjä kirjautunut sisään
    if (!isset($_SESSION["username"])) {
        // Istuntoa ei ole asetettu, ohjataan käyttäjä kirjautumissivulle
        header("Location: login.php");
        exit();
    }

    $servername = "localhost";
    $databasename = "verkkokauppa";
    $username = "root";
    $dbpassword = "";

try {
    // Luodaan yhteys MySLi tai PDO
    $conn = new PDO("mysql:host=$servername;dbname=$databasename", $username, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Tehdään tietokanta-kysely kirjautumista varten.
    $login_query = "SELECT * FROM users";
        $stmt = $conn->prepare($login_query);
        $stmt->execute();
    }
        catch (PDOException $e) {
        echo "Virhe: " . $e->getMessage();
    }

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
                <img src="images/banner_small.png">
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
                <a href=""><img src="images/menutext.png" class="log"> <!--Luotu luokka "log" javascriptia varten-->
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

    <div class="member-area-main">
        <?php
            echo "<h2>Tervetuloa " . $_SESSION["username"] . "!</h2>";
        ?>
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
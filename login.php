<?php
   require 'includes/dbconn.php';
   require 'includes/dbenquiry.php';
   include 'includes/dbsearchbar.php';

    //Tarkistetaan, onko käyttäjä jo kirjautunut
    if(isset($_SESSION["username"])) {
        //Siirretään käyttäjä memberArea-sivulle
        header("Location: memberArea.php");
        exit();
    } 

    include 'partials/doc.php';
    include 'partials/header.php';
    include 'partials/nav.php';
?>
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
<?php
    include 'partials/footer.php';
    include 'scripts/navScript.php';
    include 'partials/htmlEnd.php';
?>
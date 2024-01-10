<!--KIRJAUTUMISLOMAKE-->
<div class="login-register-container">
        <div class="login-form-container">
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

    // Tarkistetaan, onko käyttäjä kirjautunut sisään
    if (!isset($_SESSION["username"])) {
        // Istuntoa ei ole asetettu, ohjataan käyttäjä kirjautumissivulle
        header("Location: login.php");
        exit();
    }
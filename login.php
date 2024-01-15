<?php
    require_once 'includes/config_session.inc.php';
    require_once 'includes/signup_view.inc.php';
    require_once 'includes/login_view.inc.php';

    include 'partials/doc.php';
    include 'partials/header.php';
    include 'partials/nav.php';
?>
<main>
    <div class="login-signup-container">
        <div class="login-form">
            <?php output_username(); ?>

            <?php
            if(!isset($_SESSION["user_id"])) {?>
                <h3>Kirjautuminen</h3>

                <form action="includes/login.inc.php" method="post">
                    <input type="text" name="username" placeholder="Käyttäjätunnus"><br>
                    <input type="password" name="password" placeholder="Salasana"><br>
                    <button>Kirjaudu sisään</button>
                </form>

            <?php } ?>

            <?php
            
                check_login_errors();
            ?>
        </div>
        <div class="signup-form">
            <h3>Luo tunnukset</h3>

            <form action="includes/signup.inc.php" method="post">
                <?php
                    signup_inputs()
                    ?>
                    <input type="text" name="firstname" placeholder="Nimi"><br>
                    <input type="text" name="lastname" placeholder="Sukunimi"><br>
                    <input type="text" name="address" placeholder="Osoite"><br>
                <button>Lähetä</button>
            </form>

            <?php
                check_signup_errors();
            ?>
        </div>
    </div>
</main>
<?php
    include 'partials/footer.php';
    include 'partials/htmlEnd.php';
?>

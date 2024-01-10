<?php
     require_once "includes/config_session.inc.php";
     require_once "includes/signup_view.inc.php";
     require_once "includes/login_view.inc.php";
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
<main>
    

    <?php output_username(); ?>

    <?php
    if(!isset($_SESSION["user_id"])) {?>
    <h3>Login</h3>

    <form action="includes/login.inc.php" method="post">
        <input type="text" name="username" placeholder="Username">
        <input type="password" name="password" placeholder="Password">
        <button>Login</button>
    </form>

    <?php } ?>

    <?php
        check_login_errors();
    ?>

    <h3>Signup</h3>

    <form action="includes/signup.inc.php" method="post">
        <?php
            signup_inputs()
        ?>
        <button>Signup</button>
    </form>

    <?php
        check_signup_errors();
    ?>
</main>
<?php
    include 'partials/footer.php';
    include 'scripts/navScript.php';
    include 'partials/htmlEnd.php';
?>
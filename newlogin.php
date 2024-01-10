<?php
    require_once "includes/config_session.inc.php";
    require_once "includes/signup_view.inc.php";
    require_once "includes/login_view.inc.php";
    include 'partials/doc.php';
    include 'partials/header.php';
    include 'partials/nav.php';
?>
<main>
    <?php output_username(); //login_view.inc.php?>

    <?php
    if(!isset($_SESSION["user_id"])) {?>
    <h3>Login</h3>

    <form action="includes/login.inc.php" method="post">
        <input type="text" name="username" placeholder="Email">
        <input type="password" name="password" placeholder="Password">
        <button>Login</button>
    </form>

    <?php } ?>

    <?php
        check_login_errors(); //login_view.inc.php
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
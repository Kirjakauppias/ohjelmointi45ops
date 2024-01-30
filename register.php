<?php
include 'functions_partials.php';
require_once 'includes/signup_view.inc.php';
require_once 'includes/db_enquiry.inc.php';


includeUpperElements();
?>   
    <div class="signup-form">
    <?php
        if(isset($_SESSION['user_username'])){
            echo "<h3>Olet jo kirjautunut sisään.</h3>";
        } else { ?>
            <h3>Luo tunnukset</h3>

            <form action="includes/signup.inc.php" method="post" class="signup-form">
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
        }
            ?>
    </div>
<?php
includeBottomElements();

/*Session testauskoodi.
echo "<pre>";
var_dump($_SESSION);
echo "</pre>";*/
?>

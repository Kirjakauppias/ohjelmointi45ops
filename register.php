<?php

    require 'includes_other/dbconn.php';
    require 'includes_other/dbenquiry.php';
    include 'includes_other/dbsearchbar.php';

    include 'partials/doc.php';
    include 'partials/header.php';
    include 'partials/nav.php';
?>

<main>   
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
</main>

<?php
    include 'partials/footer.php';
    include 'scripts/navScript.php';
    include 'partials/htmlEnd.php';
?>

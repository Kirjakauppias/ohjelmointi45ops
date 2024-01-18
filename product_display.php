<?php
//TÄMÄ SIVU TULOSTAA SEN TUOTTEEN, JONKA KÄYTTÄJÄ ON VALINNUT

    require_once 'includes_other/dbconn.php';
    require_once 'includes_other/dbenquiry.php';
    require_once 'loops/product_model.php';
    include_once 'includes_other/dbsearchbar.php';
    include_once 'partials/doc.php';
    require_once 'partials/header.php';
    include_once 'partials/nav.php';

    echo "<main>";
        displayGetProduct($conn);
    echo "</main>";

    include 'partials/footer.php';
    include 'scripts/navScript.php';
    include 'partials/htmlEnd.php';
?>

<?php
    //SIVU JOSSA ESITETÄÄN KAIKKI TUOTTEET
    require 'includes_other/dbconn.php';
    require 'includes_other/dbenquiry.php';
    include 'includes_other/dbsearchbar.php';

    include 'partials/doc.php';
    include 'partials/header.php';
    include 'partials/nav.php';

    echo "<main>";                                                          
    include 'loops/all_products.loop.php'; //Looppi jossa esitetään kaikki tuotteet.
    echo "</main>";

    include 'partials/footer.php';
    include 'scripts/navScript.php';
    include 'partials/htmlEnd.php';
?>

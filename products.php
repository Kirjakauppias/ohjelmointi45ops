<?php
    //SIVU JOSSA ESITETÄÄN KAIKKI TUOTTEET
    include 'includeFunctions.php';
    require 'includes_other/dbconn.php';
    require 'includes_other/dbenquiry.php';
    include 'includes_other/dbsearchbar.php';

includeUpperElements();                                                         
    include 'loops/all_products.loop.php'; //Looppi jossa esitetään kaikki tuotteet.
includeBottomElements();
?>

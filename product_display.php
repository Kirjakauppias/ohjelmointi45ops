<?php
//TÄMÄ SIVU TULOSTAA SEN TUOTTEEN, JONKA KÄYTTÄJÄ ON VALINNUT
include 'includeFunctions.php';
require_once 'includes_other/dbconn.php';
require_once 'includes_other/dbenquiry.php';
require_once 'loops/product_model.php';
include_once 'includes_other/dbsearchbar.php';

includeUpperElements();
    displayGetProduct($conn);
includeBottomElements();
?>

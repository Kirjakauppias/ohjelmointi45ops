<?php
//TÄMÄ SIVU NÄYTTÄÄ 6 TUOTETTA SATUNNAISESSA JÄRJESTYKESSSÄ
require_once 'includes/product_model.inc.php';
require_once 'includes/product_view.inc.php';

$laskuri = 0;
$randomProducts = getRandomProducts($pdo_conn); //Tietokantahaku-funktio

foreach ($randomProducts as $rivi) {
    if ($laskuri >= 6) {
        break;
    }
        printProduct($rivi);
        $laskuri++;
}
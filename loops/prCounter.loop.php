<?php
//TÄMÄ SIVU NÄYTTÄÄ 6 TUOTETTA SATUNNAISESSA JÄRJESTYKESSSÄ
require_once 'product_model.php';

$laskuri = 0;
$randomProducts = getRandomProducts($conn); //Tietokantahaku-funktio

foreach ($randomProducts as $rivi) {
    if ($laskuri >= 6) {
        break;
    }
        printProduct($rivi);
        $laskuri++;
}
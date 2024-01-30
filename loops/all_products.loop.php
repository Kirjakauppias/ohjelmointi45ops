<?php
//TÄMÄ TIEDOSTO TULOSTAA KAIKKI TUOTTEET

require_once 'includes/product_model.inc.php';
require_once 'includes/product_view.inc.php';

//Muuttuja arvoksi tietokantahaku -funktio joka palauttaa kaikki tuotteet
$products = getAllProducts($pdo_conn);

foreach ($products as $rivi) {
    printProduct($rivi);
}     
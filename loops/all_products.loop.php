<?php
//TÄMÄ TIEDOSTO TULOSTAA KAIKKI TUOTTEET

require_once 'product_model.php';

//Muuttuja arvoksi tietokantahaku -funktio joka palauttaa kaikki tuotteet
$products = getAllProducts($conn);

foreach ($products as $rivi) {
    printProduct($rivi);
}     

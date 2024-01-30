<?php
//Tiedosto jossa tehdään yhteys tietokantaan.
//Projektin pitäisi käyttää tätä tiedostoa kaikissa tietokannan yhteydenotoissa.

$host = "localhost";      //Tietokantapalvelimen osoite. "localhost" -> tietokantapalvelin on samassa koneessa kuin web-palvelin.
$dbname = "verkkokauppa"; //Tietokannan nimi.
$dbusername ="root";      //Käyttäjätunnus -> TÄMÄ MUUTETTAVA, TIETOTURVA-RISKI.
$dbpassword = "";         //Tietokannan salasana ->  TÄMÄ MUUTETTAVA, TIETOTURVA-RISKI.

try {
    //Uusi PDO-yhteysolio.
    $pdo_conn = new PDO("mysql:host=$host;dbname=$dbname", $dbusername, $dbpassword);
    //Attribuutti virheiden käsittelyä varten.
    $pdo_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    //Käsitellään PDO-poikkeuksia jos jokin menee pieleen tietokantakyselyissä tai -toiminnoissa.
    die("Connection failed: " . $e->getMessage());
}

// Include tiedostoissa yleensä jätetään php:n lopetus tagi pois.
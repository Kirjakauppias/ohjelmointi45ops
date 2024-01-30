<?php
//TIEDOSTO JOSSA ON HTML-RAKENNE-TIEDOSTOT FUNKTIOINA   
function includeUpperElements(){
    include 'partials/doc.php';                      //HTML -sivun alkukoodi on täällä.
    include 'partials/header.php';                   //Otsikko -tason koodi on täällä.
    include 'partials/nav.php';                      //Navigointi -koodi on täällä.
    echo "<main>";
}
function includeBottomElements(){
    echo "</main>";
    include 'partials/footer.php';                  //Footer -sivun koodi.
    include 'scripts/navScript.php';                //Navigointi -scripti on täällä.
    include 'partials/htmlEnd.php';                 //HTML -sivun lopetustagit.
}
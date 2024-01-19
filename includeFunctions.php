<?php

function includeUpperElements(){
    include 'partials/doc.php';                      //HTML -sivun alkukoodi on täällä.
    include 'partials/header.php';                   //Otsikko -tason koodi on täällä.
    include 'partials/nav.php';                      //Navigointi -koodi on täällä.
}
function includeBottomElements(){
    include 'partials/footer.php';
    include 'scripts/navScript.php';
    include 'partials/htmlEnd.php';
}
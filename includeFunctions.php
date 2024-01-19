<?php
function includeUpperElements(){
    include 'partials/doc.php';                      //HTML -sivun alkukoodi on täällä.
    include 'partials/header.php';                   //Otsikko -tason koodi on täällä.
    include 'partials/nav.php';                      //Navigointi -koodi on täällä.
    echo "<main>";
}
function includeBottomElements(){
    echo "</main>";
    include 'partials/footer.php';
    include 'scripts/navScript.php';
    include 'partials/htmlEnd.php';
}
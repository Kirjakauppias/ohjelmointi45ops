<?php
//ETUSIVU
require_once 'includes_other/dbenquiry.php';                                                 
include 'includes_other/dbsearchbar.php';        //Hakupalkin koodi on täällä.
include 'includeFunctions.php';
includeUpperElements();                                                                
include 'loops/prCounter.loop.php';      //Tuotteiden esityskoodi on täällä.
includeBottomElements();


echo "<pre>";
var_dump($_SESSION);
echo "</pre>";
?>
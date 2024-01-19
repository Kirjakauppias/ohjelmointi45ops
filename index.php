<?php
    //ETUSIVU
    require_once 'includes_other/dbconn.php';        //Yhteydenotto tietokantaan
    require_once 'includes_other/dbenquiry.php';                                                 
    include 'includes_other/dbsearchbar.php';        //Hakupalkin koodi on täällä.
    include 'includeFunctions.php';
includeUpperElements();
    echo "<main>";                                                                  
        include 'loops/prCounter.loop.php';          //Tuotteiden esityskoodi on täällä.
    echo "</main>";
includeBottomElements();
?>

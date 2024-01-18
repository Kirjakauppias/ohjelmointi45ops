<?php
    //ETUSIVU
    require_once 'includes_other/dbconn.php';        //Yhteydenotto tietokantaan
    require_once 'includes_other/dbenquiry.php';     //Tietokanta-hakuja TEHTÄVÄ:18.1.
                                                     //Haut olisi hyvä olla funktioina.
    include 'includes_other/dbsearchbar.php';        //Hakupalkin koodi on täällä.

    include 'partials/doc.php';                      //HTML -sivun alkukoodi on täällä.
    include 'partials/header.php';                   //Otsikko -tason koodi on täällä.
    include 'partials/nav.php';                      //Navigointi -koodi on täällä.
    
    echo "<main>";                                                                  
        include 'loops/prCounter.loop.php';          //Tuotteiden esityskoodi on täällä.
    echo "</main>";
    
    include 'partials/footer.php';                   //Footerin koodin on täällä.
    include 'scripts/navScript.php';                 //Scripti jossa nav -palkki tulee esiin.
    include 'partials/htmlEnd.php';                  //HTML -sivun lopetuskoodi on täällä.
?>

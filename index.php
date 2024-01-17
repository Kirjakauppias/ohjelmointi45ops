<?php

    require 'includes_other/dbconn.php';
    require 'includes_other/dbenquiry.php';
    include 'includes_other/dbsearchbar.php';

    include 'partials/doc.php';
    include 'partials/header.php';
    include 'partials/nav.php';
    
    echo "<main>";                                                                  
    include 'loops/prCounter.php';
    echo "</main>";
    
    include 'partials/footer.php';
    include 'scripts/navScript.php';
    include 'partials/htmlEnd.php';
?>

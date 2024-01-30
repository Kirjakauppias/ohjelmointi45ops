<?php
include 'functions_partials.php';   // Tiedosto jossa on partials -tiedostot funktioina.
require_once 'includes/db_enquiry.inc.php';

includeUpperElements();             // HTML rakennefunktio.

include 'loops/all_products.loop.php';

includeBottomElements();            // HTML -rakennefunktio. 

/*Session testauskoodi.
echo "<pre>";
var_dump($_SESSION);
echo "</pre>";*/ 
?>
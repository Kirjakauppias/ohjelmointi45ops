<?php
// TÄMÄ TIEDOSTO NÄYTTÄÄ YHDEN VALITUN TUOTTEEN TIEDOT
require_once 'includes/db_connection.inc.php';
require_once 'includes/db_enquiry.inc.php';
require_once 'includes/product_view.inc.php';
include 'functions_partials.php';

includeUpperElements();
    displayGetProduct($pdo_conn);
includeBottomElements();

?>
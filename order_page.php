<?php
//ETUSIVU
require_once 'includes/db_enquiry.inc.php';                                                 
include 'functions_partials.php';
includeUpperElements();                       

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['finalize_order'])) {
    // Tässä voit käyttää $_POST-muuttujia lomakkeen tiedon käsittelemiseen
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $address = $_POST['address'];

    // Voit myös käyttää $_SESSION['cart'] -muuttujaa näyttääksesi ostoskorin tiedot
    $cart_items = $_SESSION['cart'];

    // Tee tarvittavat toimet tässä, kuten tallenna tiedot tietokantaan tai näytä ne käyttäjälle.
    
    // Esimerkki: Tulosta ostoskorin tiedot
    echo "<h2>Ostoskorin tiedot:</h2>";
    echo "<table class='cart-table'>";
    echo "<tr>
            <th>Tuotteen nimi</th>
            <th>Hinta</th>
            <th>Kappalemäärä</th>
         </tr>";

    foreach ($cart_items as $cart_item) {
        echo "<tr>";
        echo "<td>" . $cart_item["productName"] . "</td>";
        echo "<td>€" . $cart_item["price"] . "</td>";
        echo "<td>" . $cart_item["quantity"] . "</td>";
        echo "</tr>";
    }

    $total_price = array_sum(array_column($cart_items, 'price'));
    echo "<tr>
            <td colspan='2'><strong>Yhteensä</strong></td>
            <td><strong>€" . number_format($total_price, 2) . "</strong></td>
          </tr>";
    echo "</table>";

    // Tulosta yhteystiedot
    echo "<h2>Yhteystiedot:</h2>";
    echo "Etunimi: $firstname<br>";
    echo "Sukunimi: $lastname<br>";
    echo "Sähköposti: $email<br>";
    echo "Osoite: $address<br>";

   
}
?>
    <!--Lomake joka lähettää tilauksen-->
    <form action="order_process.php" method="post">
        <input type="submit" name="place_order" value="Tilaa">
    </form>
<?php
includeBottomElements();
?>

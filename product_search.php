<?php
    require 'includes/dbconn.php';
    include 'partials/doc.php';
    include 'partials/header.php';
    include 'partials/nav.php';

     // Tarkistetaan, onko hakuterminä annettu
     if (isset($_GET['search'])) {
        $searchTerm = $_GET['search'];
        // Suoritetaan haku tietokannasta hakutermin perusteella
        $products_kysely = $conn->prepare("SELECT * FROM products WHERE ProductName LIKE :searchTerm");
        $products_kysely->bindValue(':searchTerm', '%' . $searchTerm . '%', PDO::PARAM_STR);
        $products_kysely->execute();
    } else {
        // Jos hakuterminä ei ole annettu, ohjataan käyttäjä takaisin etusivulle
        header("Location: index.php");
        exit();
    }
?>
<main>
    <div class="search-results-main">
        <?php
            while ($rivi = $products_kysely->fetch()) {
                echo "<div class='product-container'>";
                echo "<h3>" . $rivi["ProductName"] . "</h3>";
                echo "<a href='product_display.php?ProductID=" . $rivi["ProductID"]. "'><img src=product_images/". $rivi["ImageURL"] . "></a>";
                echo "<div class='product-price-cart-container'>";
                echo "<p>€ " . $rivi["Price"] . "</p>" . "<a href=''><img src='images/cart_small.png'>";
                echo "</div>";
                echo "</div>";
            }
        ?>
    </div>
</main>
<?php
    include 'partials/footer.php';
    include 'scripts/navScript.php';
    include 'partials/htmlEnd.php';
?>
<?php
    require 'includes/dbconn.php';
    require 'includes/dbenquiry.php';

    $products_kysely->execute();

    // Tarkistetaan, onko hakuterminä annettu
    if (isset($_GET['search'])) {
        $searchTerm = $_GET['search'];
        // Suoritetaan haku tietokannasta hakutermin perusteella
        $products_kysely = $conn->prepare("SELECT * FROM products WHERE ProductName LIKE :searchTerm");
        $products_kysely->bindValue(':searchTerm', '%' . $searchTerm . '%', PDO::PARAM_STR);
        $products_kysely->execute();
        // Ohjataan käyttäjä product_search -sivulle hakutulosten kanssa
        header("Location: product_search.php?search=" . urlencode($searchTerm));
        exit();
    }

    include 'partials/doc.php';
    include 'partials/header.php';
    include 'partials/nav.php';
?>
    <div class="index-main">                                                                  
    <?php
            $laskuri = 0;
            while($rivi = $products_kysely->fetch()) {
                if ($laskuri >= 6) {
                    break;
                }
                echo "<div class='product-container'>";
                    echo "<h3>" . $rivi["ProductName"] . "</h3>";
                    echo "<a href='product_display.php?ProductID=" . $rivi["ProductID"]. "'><img src=product_images/". $rivi["ImageURL"] . "></a>";
                    echo "<div class='product-price-cart-container'>";
                    echo "<p>€ " . $rivi["Price"] . "</p>" . "<img src='images/cart_small.png'>";
                    echo "</div>";
                echo "</div>";
                $laskuri++;
            }
        ?>
    </div>
<?php
    include 'partials/footer.php';
    include 'scripts/navScript.php';
    include 'partials/htmlEnd.php';
?>

<?php
    session_start();

    // Tarkistetaan, onko käyttäjä kirjautunut sisään
    if (!isset($_SESSION["username"])) {
        // Istuntoa ei ole asetettu, ohjataan käyttäjä kirjautumissivulle
        header("Location: login.php");
        exit();
    }

    $servername = "localhost";
    $databasename = "verkkokauppa";
    $username = "root";
    $dbpassword = "";

try {
    // Luodaan yhteys MySLi tai PDO
    $conn = new PDO("mysql:host=$servername;dbname=$databasename", $username, $dbpassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // Tehdään tietokanta-kysely kirjautumista varten.
    $login_query = "SELECT * FROM users";
        $stmt = $conn->prepare($login_query);
        $stmt->execute();
    }
        catch (PDOException $e) {
        echo "Virhe: " . $e->getMessage();
    }

    // Tarkistetaan, onko painiketta painettu
    if(isset($_POST['logout'])) {
        // Poistetaan käyttäjän istunto
        session_destroy();
        // Ohjataan käyttäjä takaisin index.php-sivulle
        header("Location: index.php");
        exit();
    }

    include 'partials/doc.php';       
    include 'partials/headerLogged.php';
    include 'partials/nav.php'; 
?>
    <div class="member-area-main">
        <?php
            echo "<h2>Tervetuloa " . $_SESSION["username"] . "!</h2>";
        ?>
    </div>
<?php
    include 'partials/footer.php';
    include 'scripts/navScript.php';
    include 'partials/htmlEnd.php';
?>

   
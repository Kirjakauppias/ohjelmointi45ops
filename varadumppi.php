<?php
session_start();

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

    if($_SERVER["REQUEST_METHOD"] == "POST") {  //Login-sivulta on täytetty kirjautumislomake
        $usernameInput = $_POST["username"];    //Alustetaan muuttujat login-sivulta siirretyillä tiedoilla
        $passwordInput = $_POST["password"];
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) { //Loopataan user-tietokannasta
            $usernameDB = $row['Email'];                //Alustetaan muuttujat user-tietokannasta olevilla tiedoilla / rivi
            $passwordDB = $row['Password'];

            if ($usernameInput == $usernameDB && $passwordInput == $passwordDB){    //Jos login-lomakkeella annetut tiedot täsmäävät tietokannan riviin
                //Tiedot oikein
                //Lisätään koodi, jotta käyttäjä on "kirjautunut sisään".
                $_SESSION["username"] = $usernameDB; 
                header("Location: memberArea.php");
                exit();
            }
        }
        header("Location: login.php?error=login");
        exit();
    }
}
catch (PDOException $e) {
    echo "Virhe: " . $e->getMessage();
}
?>

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
?>

<?php
    // Tarkistetaan, onko ProductID asetettu URL-parametreihin
   // if (isset($_GET['ProductID'])){

    // Tietokanta yhteys
    // Palvelimen nimi muuttujaan
    $servername = "localhost";
    $databasename = "verkkokauppa";
    $username = "root";
    $password = "";
    
    //Yritetään
    try {
        //Luodaan yhteys, joka on PDO objekti
        $conn = new PDO("mysql:host=$servername;dbname=$databasename", $username, $password);

        //PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $productID = $_GET['ProductID'];    //Haetaan URL:stä oleva ProductID muuttujaan
        $products_kysely = $conn->prepare("SELECT * FROM products WHERE ProductID = :productID");
        $products_kysely->bindParam(':productID', $productID);
        $products_kysely->execute();

        $product = $products_kysely->fetch();
    }
    catch (PDOException $e) {
        // Yhteys epäonnistui
        echo "". $e->getMessage();
    }
//} echo "<p>Tuotetta ei löytynyt!</p>";  //URL:ssä ei ollut ProductID:tä joten siitä virheilmoitus
?>
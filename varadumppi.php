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
<?php
// Tietokanta yhteys
    $servername = "localhost";
    $databasename = "verkkokauppa";
    $username = "root";
    $password = "";

    // Yritetään
    try {
        // Luodaan yhteys, joka on PDO objekti
        $conn = new PDO("mysql:host=$servername;dbname=$databasename", $username, $password);

        // PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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
    } catch (PDOException $e) {
        // Yhteys epäonnistui
        echo "". $e->getMessage();
    }
?>

<?php
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

        $products_kysely = $conn->prepare("SELECT * FROM products"   );

        $products_kysely->execute();
    }
    catch (PDOException $e) {
        // Yhteys epäonnistui
        echo "". $e->getMessage();
    }
?>

<?php
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

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            //Haetaan tietokannan viimeisin userID
            $last_userID_query = $conn->query("SELECT MAX(UserID) AS LastUserID FROM users");
            $last_userID_result = $last_userID_query->fetch();
            $last_userID = $last_userID_result["LastUserID"];

            //Lisätään viimeisintä UserID:tä yhdellä seuraavalle käyttäjälle
            $userID = $last_userID + 1;

            //Laitetaan käyttäjän syöttämät arvot muuttujiin
            $firstname = $_POST['firstname'];
            $lastname = $_POST['lastname'];
            $email = $_POST['email'];
            $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
            $address = $_POST['address'];
            $userType = 'Customer'; //Oletuksena customer 
            
            //Lisätään uusi user data tietokantaan
            $stmt = $conn->prepare("INSERT INTO users (UserID, FirstName, LastName, Password, Email, Address, UserType) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$userID, $firstname, $lastname, $password, $email, $address, $userType]);
    
            echo "Rekisteröinti onnistui!";
        } 
           
        
    }
    catch (PDOException $e) {
        // Yhteys epäonnistui
        echo "". $e->getMessage();
    }

    echo "<div class='product-container'>";
                    echo "<h3>" . $rivi["ProductName"] . "</h3>";
                    echo "<a href='product_display.php?ProductID=" . $rivi["ProductID"]. "'><img src=product_images/". $rivi["ImageURL"] . "></a>";
                    echo "<div class='product-price-cart-container'>";
                        echo "<p>€ " . $rivi["Price"] . "</p>" . "<a href=''><img src='images/cart_small.png'></a>";
                    echo "</div>";
                    echo "</div>";
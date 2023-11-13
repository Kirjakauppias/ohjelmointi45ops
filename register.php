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
?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>

<header>
        <!--BANNERI & SEARCH-->
        <div class="banner-search-container">
            <!--BANNERI-->
            <div class="banner">
                <img src="images/banner_small.png">
            </div>
        
            <!--SEARCHBAR-->
            <div class="search-container">
                <input type="text" placeholder="Etsi tuotteita">
                <button>Etsi</button>
            </div>
        </div>
        
        <!--MENU & KIRJAUTUMINEN & OSTOSKORI-->
        <div class="menu-log-cart-container">
            <div class="menu">
                <img src="images/menutext.png" class="log"> <!--Luotu luokka "log" javascriptia varten-->
            </div>
            <div class="log">
                <a href="login.php"><img src="images/logtext.png"></a>
            </div>
            <div class="cart">
                <a href=""><img src="images/carttext.png"></a>
            </div>
        </div>
    </header>
    
    <!--NAVIGOINTI-->
    <nav>
        <div class="frontpage-link">
            <a href="index.php">ETUSIVU</a>
        </div>
        <div class="all-products-link">
            <a href="products.php">KAIKKI TUOTTEET</a>
        </div>
    </nav>

    <form action="register.php" method="post">
        <input type="text" name="firstname" placeholder="Etunimi"><br>

        <input type="text" name="lastname" placeholder="Sukunimi"><br>

        <input type="email" name="email" placeholder="Email"><br>

        <input type="password" name="password" placeholder="Salasana"><br>

        <input type="text" name="address" placeholder="Osoite"><br>

        <input type="submit" value="Rekisteröidy">
    </form>
</body>
</html>
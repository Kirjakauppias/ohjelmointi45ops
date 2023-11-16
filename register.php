<?php
    require 'includes/dbconn.php';

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

    include 'partials/doc.php';
    include 'partials/header.php';
    include 'partials/nav.php';
?>

    <div class="index-main">
    <form action="register.php" method="post">
        <input type="text" name="firstname" placeholder="Etunimi"><br>

        <input type="text" name="lastname" placeholder="Sukunimi"><br>

        <input type="email" name="email" placeholder="Email"><br>

        <input type="password" name="password" placeholder="Salasana"><br>

        <input type="text" name="address" placeholder="Osoite"><br>

        <input type="submit" value="Rekisteröidy">
    </form>
    </div>
<?php
    include 'partials/footer.php';
    include 'scripts/navScript.php';
    include 'partials/htmlEnd.php';
?>
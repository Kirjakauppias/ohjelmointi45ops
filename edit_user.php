<?php
    session_start();
    // Tällä sivulle saavutaan view_users.php tiedostosta
    // Käyttäjän Id saadaan GET parametrissä $_GET['UserID']

    // Sivulla näytetään valitun käyttäjän tiedot ja käyttäjä voi muokata niitä
    // Lopuksi käyttäjä voi napsauttaa "Update"-nappia, joka suorittaa
    // tietokannan päivittämisen uusilla tiedoilla.

    require_once 'includes_admin/db_connection.inc.php';
    require_once 'includes_admin/user_operations.inc.php';

    // Suoritetaan päivitys, jos saavutaan sivulle POST metodilla ja sitten uudelleen ohjataan etusivulle
    // Huom. jos päivitys epäonnistuu, käyttäjän pitää navigoida edit sivulle uudestaan ja antaa tiedot uudelleen
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        if(isset($_POST['submit'])){

            $id = $_POST['UserID'];

            // Tässä luodaan association array, jossa on uusi data key=>value muodossa
            $newData = [
                'Username' => $_POST['Username'],
                'FirstName' => $_POST['Firstname'],
                'LastName' => $_POST['Lastname'],
                'Email' => $_POST['Email'],
                'Address' => $_POST['Address'],   
                'UserType' => $_POST['Usertype'],
                'Password' => $_POST['Password'],
                 
            ];

            // Tietokannan päivitys funktio
            updateUserDetails($pdo_conn, $id, $newData);

            header("Location: view_users.php");
            die();
        
        }
    }


    // Otetaan Id talteen
    // Virhe johtui $_GET['userID'] tekstistä, eli kirjoitettu pienellä u kirjaimella
    // GET pitää olla kirjoitettu samalla tavalla kuin view_users.php tiedoston
    // a-elementin linkki
    if(isset($_GET['UserID'])){
        $_SESSION["user_id"] = $_GET['UserID'];
        // Tarkistetaan onko kirjautuneella käyttäjällä sama id kuin mitä se yrittää
        // hakea
        // $_SESSION["user_id"] == kirjautuneen käyttäjän Id
        // $_SESSION voi luottaa, mutta $_GET ja $_POST ei voi luottaa
        if($_SESSION["user_id"] === $_GET['UserID']){    //UserID fixattu kuntoon 


            $userId = $_GET['UserID'];
            $userDetails = getUserDetails($pdo_conn, $userId);
            //print_r($userDetails);
        }
        
        
    }

?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <a href="admin_login.php">Takaisin pääsivulle</a>
    <!-- Virheiden käsittely (userId puuttuu tai käyttäjän tiedon haku ei onnistu) -->
    <h2>Edit User</h2>
    <form action="edit_user.php" method="post">
        <label for="UserID">UserID:</label>
        <input type="text" name="UserID" value="<?= $userDetails['UserID'] ?>" readonly>

        <label for="Username">Username:</label>
        <input type="text" name="Username" value="<?= htmlspecialchars($userDetails['Username']) ?>" required>

        <label for="Firstname">Firstname:</label>
        <input type="text" name="Firstname" value="<?= htmlspecialchars($userDetails['FirstName']) ?>" required>

        <label for="Lastname">Lastname:</label>
        <input type="text" name="Lastname" value="<?= htmlspecialchars($userDetails['LastName']) ?>" required>
    <br><br>
        <label for="Email">Email:</label>
        <input type="email" name="Email" value="<?= htmlspecialchars($userDetails['Email']) ?>" required>

        <label for="Address">Address:</label>
        <input type="address" name="Address" value="<?= htmlspecialchars($userDetails['Address']) ?>" required>

        <label for="Usertype">Usertype:</label>
        <input type="usertype" name="Usertype" value="<?= htmlspecialchars($userDetails['UserType']) ?>" required>

        <label for="Password">Password:</label>
        <input type="password" name="Password" value="" required>

        <!-- Lopullinen datan validointi täytyy suorittaa palvelimella -->
        <!-- käyttäjä pystyy muokkaamaan koodia / dataa omalla selaimellaan / koneellaan -->
        <!-- esimerkiksi voi poistaa required attribuutin tai email inputin => text inputtiin -->
        <input type="submit" name="submit" value="Update">
    </form>

</body>
</html>
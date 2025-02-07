<?php
// === tarkistetaan onko arvot samat ja onko datatyypit samat
// esim. == tulkitsee 5 ja "5" ovat sama arvo
// mutta === vertaa datatyypin myös, jolloin 5 ja "5" eivät ole sama arvo
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $email = $_POST["email"];
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
    $address = $_POST["address"];

    try {
        require_once 'db_connection.inc.php';
        require_once 'signup_model.inc.php'; // Model include ensin
        require_once 'signup_controller.inc.php'; // Sitten controller include

        // ERROR HANDLERS
        $errors = []; // Talennetaan virheet key -> value pareina

        if (is_input_empty($username, $password, $email)) {
            $errors["empty_input"] = "Täytä kaikki tiedot!";
        }
        if (is_email_invalid($email)) {
            $errors["invalid_email"] = "Sähköposti on väärässä muodossa!";
        }
        if (is_username_taken($pdo_conn, $username)) {
            $errors["username_taken"] = "Käyttäjätunnus on jo käytössä!";
        }
        if (is_email_registered($pdo_conn, $email)) {
            $errors["email_used"] = "Sähköposti on jo rekisteröity!";
        }

        // Tarvitaan seession aloitus, ennen kuin virheet voidaan tallentaa
        // sesssion_start() löytyy config_session tiedostosta
        require_once 'config_session.inc.php'; //Käytetään turvallisempia sessio asetuksia
        
        // Jos taulukko ei ole tyhjä, on tullut virheitä
        // Jos taulukossa on dataa: $errors === true
        if ($errors) {
            $_SESSION["errors_signup"] = $errors;

            $signupData = [
                "username" => $username,
                "email" => $email
            ];
            $_SESSION["signup_data"] = $signupData;

            header("Location: ../register.php");

            $pdo_conn = null;
            $stmt = null;

            die();
        }

        create_user($pdo_conn, $username, $password, $email, $firstname, $lastname, $address);
        header("Location: ../register.php?signup=success");

        // Katkaistaan yhteys
        $pdo_conn = null;
        $stmt = null;
        die();

    } catch (PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
} else {
    header("Location: ../register.php");
    die();
}


// Include tiedostoissa yleensä jätetään php:n lopetus tagi pois
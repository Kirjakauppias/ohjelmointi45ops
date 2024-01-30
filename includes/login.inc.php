<?php
// TIEDOSTO JOSSA TARKISTETAAN KIRJAUTUMISTIETOJA

// Tarkistetaan että kirjautumislomakkeessa on tietoja
if($_SERVER["REQUEST_METHOD"] === "POST"){
    $username = $_POST["username"];
    $password = $_POST["password"];

    try {
        require_once 'db_connection.inc.php';
        require_once 'login_model_inc.php';
        require_once 'login_controller.inc.php';

        // ERROR HANDLERS
        $errors = []; // Tallennetaan virheet key -> value pareina.

        // Haetaan funktio login_controller tiedostosta.
        if (is_input_empty($username, $password)){
            $errors["empty_input"] = "Täytä kaikki tiedot!";
        }

        // $pdo_conn tulee 'db_connection.inc.php' -tiedostosta.
        $result = get_user($pdo_conn, $username);

        if (is_username_wrong($result)) {
            $errors["login_incorrect"] = "Väärät kirjautumistiedot!";
        }

        // Tarkistetaan onko käyttäjän syöttämä $password ja tietokannan $result['Password']
        // samat arvot.
        if (!is_username_wrong($result) && is_password_wrong($password, $result["Password"])) {
            $errors["login_incorrect"] = "Väärät kirjautumistiedot!";
        }

        // Tarvitaan session aloitus, ennen kuin virheet voidaan tallentaa
        // session_start() löytyy config_session tiedostosta.
        require_once 'config_session.inc.php';

        if($errors) {
            // Jos löytyy kirjautumis-virheitä, ohjataan etusivulle.
            $_SESSION["errors_login"] = $errors;
            header("Location: ../index.php");

            // Nollataan tietokanta-muuttujat.
            $pdo_conn = null;
            $stmt = null;

            die();
        }

        // Luodaan uusi session id, jossa on käyttäjän id mukana.
        // Päivitetään myös config_session tiedostoon session päivitys.
        $newSessionID = session_create_id();
        $sessionID = $newSessionID . "_" . $result["UserID"];
        session_id($sessionID);

        // Otetaan talteen kirjautuneen käyttäjän id ja tunnus.
        $_SESSION["user_id"] = $result["UserID"];
        $_SESSION["user_username"] = htmlspecialchars($result["Username"]);
        $_SESSION["user_type"] = htmlspecialchars($result["UserType"]);

        // Resetoidaan session aika.
        $_SESSION["last_generation"] = time();

        // Asetetaan istuntoon tunniste siitä, että käyttäjä on saapunut memberArea.php-sivulle //HOX, uutta koodia!
        $_SESSION["from_login_page"] = true;

       
        header("Location: ../index.php");

        $pdo_conn = null;
        $stmt = null;

        die();
    }
    catch(PDOException $e) {
        die("Query failed: " . $e->getMessage());
    }
}
else {
    header("Location: ../index.php");
    die();
}

/* Testauskoodia.
echo "<pre>";
var_dump($_POST);
echo "<br></br>";
var_dump($_SESSION);
echo "</pre>";*/
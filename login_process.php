<?php
    require_once 'includes_admin/db_connection.inc.php';

    if (isset($_POST['submit'])) {
        //Muuttujille annetaan ne arvot, mitkä on syötetty lomakkeeseen.
        $entered_username = $_POST['username'];
        $entered_password = $_POST['password'];

        //Suoritetaan tietokantakysely:
        $stmt = $pdo_conn->prepare("SELECT UserID, Username, Password, UserType FROM users WHERE Username = ?");
        $stmt->execute([$entered_username]);

        //Tarkistetaan käyttäjän olemassaolo ja salasanan oikeellisuus
        if($user = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $stored_password = $user['Password'];

            //Vertaillaan annettua ja tietokannassa olevaa salasanaa
            if(password_verify($entered_password, $stored_password)) {
                //Salasana on oikein
                session_start();
                $_SESSION["user_id"] = $user['UserID'];

                //Tarkista, että käyttäjä on tyyppiä "Admin"
                if ($user['UserType'] === 'Admin') {
                    //Ohjataan käyttäjä edit_user.php -sivulle
                    header("Location: view_users.php");
                    die();
                } else {
                    echo "Sinulla ei ole admin -oikeuksia.";
                    header("Location: admin_login.php");
                    die();
                }
            } else {
                echo "Väärä käyttäjätunnus tai salasana!";
                
            }
        } else {
            echo "Väärä käyttäjätunnus tai salasana!";
            
        }


    }

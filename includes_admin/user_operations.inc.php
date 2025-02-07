<?php

// Tässä tiedostossa on käyttäjän SQL kyselyt
// 1. delete_user

function delete_user($pdo, $id){
    try{ 
        // UPDATE, päivitetään taulun riviä
        $stmt = $pdo->prepare(
            "UPDATE users SET deleted_at = :deleted_time WHERE UserID = :user_id");
            //     taulu               sarakkeet                    mikä rivi

        $deletedTime = date('Y-m-d H:i:s');
        // Asetetaan parametrin :deleted_time ja _user_id
        $stmt->bindParam(':deleted_time', $deletedTime, PDO::PARAM_STR);
        $stmt->bindParam(':user_id', $id, PDO::PARAM_INT);

        $stmt->execute();
            
        return "Käyttäjä poistettu onnistuneesti!";
    }
    catch(PDOException $e){
        return "error: $e";
    }
} // delete_user

function restore_user($pdo, $id){
    try{ 
        // UPDATE, päivitetään taulun riviä
        $stmt = $pdo->prepare(
            "UPDATE users SET deleted_at = :deleted_time WHERE UserID = :user_id");
            //     taulu               sarakkeet                    mikä rivi

        $deletedTime = null;
        // Asetetaan parametrin :deleted_time ja _user_id
        $stmt->bindParam(':deleted_time', $deletedTime, PDO::PARAM_STR);
        $stmt->bindParam(':user_id', $id, PDO::PARAM_INT);

        $stmt->execute();
            
        return "Käyttäjä palautettu onnistuneesti!";
    }
    catch(PDOException $e){
        return "error: $e";
    }
} // restore_user

function getUserDetails($pdo, $userId){
    // Tarkistetaan, onko oikeus katsoa näitä tietoja
    try{
        $stmt = $pdo->prepare("SELECT * FROM users WHERE UserID = :user_id");

        $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
        $stmt->execute();
        $userDetails = $stmt->fetch(PDO::FETCH_ASSOC);

        return $userDetails;
    }
    catch(PDOException $e){
        echo "error: $e";
    }

} // getUserDetails

//                                   Taulukossa uusi data
function updateUserDetails($pdo, $userId, $newData){
    // Pitäisi vielä tarkistaa ennen muokkausta, että käyttäjällä on oikeus muokata
    // tätä asiaa
    $stmt = $pdo->prepare("UPDATE users SET Username = :username, FirstName = :firstname, LastName = :lastname, Email = :email, Address = :address, UserType = :usertype, Password = :password WHERE UserID = :user_id");
    $stmt->bindParam(':username', $newData['Username'], PDO::PARAM_STR);
    $stmt->bindParam(':firstname', $newData['FirstName'], PDO::PARAM_STR);
    $stmt->bindParam(':lastname', $newData['LastName'], PDO::PARAM_STR);
    $stmt->bindParam(':email', $newData['Email'], PDO::PARAM_STR);
    $stmt->bindParam(':address', $newData['Address'], PDO::PARAM_STR);
    $stmt->bindParam(':usertype', $newData['UserType'], PDO::PARAM_STR);
    $hashedPassword = password_hash($newData['Password'], PASSWORD_DEFAULT);
    $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
    $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);


    $stmt->execute();
} // updateUserDetails
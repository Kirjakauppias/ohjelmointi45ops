<?php
function delete_product($pdo, $id){
    try{ 
        // UPDATE, päivitetään taulun riviä
        $stmt = $pdo->prepare(
            "UPDATE products SET deleted_at = :deleted_time WHERE ProductID = :product_id");
            //     taulu               sarakkeet                    mikä rivi

        $deletedTime = date('Y-m-d H:i:s');
        // Asetetaan parametrin :deleted_time ja _user_id
        $stmt->bindParam(':deleted_time', $deletedTime, PDO::PARAM_STR);
        $stmt->bindParam(':product_id', $id, PDO::PARAM_INT);

        $stmt->execute();
            
        return "Tuote poistettu onnistuneesti!";
    }
    catch(PDOException $e){
        return "error: $e";
    }
} // delete_user

function restore_product($pdo, $id){
    try{ 
        // UPDATE, päivitetään taulun riviä
        $stmt = $pdo->prepare(
            "UPDATE products SET deleted_at = :deleted_time WHERE ProductID = :product_id");
            //     taulu               sarakkeet                    mikä rivi

        $deletedTime = null;
        // Asetetaan parametrin :deleted_time ja _user_id
        $stmt->bindParam(':deleted_time', $deletedTime, PDO::PARAM_STR);
        $stmt->bindParam(':product_id', $id, PDO::PARAM_INT);

        $stmt->execute();
            
        return "Tuote palautettu onnistuneesti!";
    }
    catch(PDOException $e){
        return "error: $e";
    }
} // restore_user
?>
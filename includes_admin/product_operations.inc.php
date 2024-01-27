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

function getProductDetails($pdo, $productID){
    try {
        $stmt = $pdo->prepare("SELECT * FROM products WHERE ProductID = :product_id");

        $stmt->bindParam(':product_id', $productID, PDO::PARAM_INT);
        $stmt->execute();
        $productDetails = $stmt->fetch(PDO::FETCH_ASSOC);

        return $productDetails;
    } catch (PDOException $e) {
        echo "error: $e";
    }
}

function updateProductDetails($pdo, $productID, $newData){
    // Add validation or permission checks before performing the update
    $stmt = $pdo->prepare("UPDATE products SET ProductName = :productName, Description = :description, Price = :price, ImageURL = :imageURL WHERE ProductID = :product_id");
    $stmt->bindParam(':productName', $newData['ProductName'], PDO::PARAM_STR);
    $stmt->bindParam(':description', $newData['Description'], PDO::PARAM_STR);
    $stmt->bindParam(':price', $newData['Price'], PDO::PARAM_STR);
    $stmt->bindParam(':imageURL', $newData['ImageURL'], PDO::PARAM_STR);
    $stmt->bindParam(':product_id', $productID, PDO::PARAM_INT);

    $stmt->execute();
}
?>
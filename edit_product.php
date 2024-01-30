<?php
session_start();


require_once 'includes/db_connection.inc.php';
require_once 'includes_admin/product_operations.inc.php'; // Update with the correct file name

    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (isset($_POST['submit'])) {
            // Get product ID from the form
            $productID = $_POST['ProductID'];

            // Create an associative array with the new data
            $newData = [
                'ProductName' => $_POST['ProductName'],
                'Description' => $_POST['Description'],
                'Price' => $_POST['Price'],
                'ImageURL' => $_POST['ImageURL'],
            ];

            // Update product details using the appropriate function
            updateProductDetails($pdo_conn, $productID, $newData);

            // Redirect to the product list page
            header("Location: view_products.php");
            die();
        }
    }

    // Retrieve product details based on the provided ProductID
    if (isset($_GET['ProductID'])) {
        $_SESSION["product_id"] = $_GET['ProductID'];

        // Check if the logged-in user has the same ID as the one being retrieved
        if ($_SESSION["product_id"] === $_GET['ProductID']) {

            $productID = $_GET['ProductID'];
            $productDetails = getProductDetails($pdo_conn, $productID);
        }
    }
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
</head>
<body>
    <a href="admin_login.php">Back to main page</a>

    <!-- Error handling for missing product ID or unsuccessful retrieval -->
    <h2>Edit Product</h2>
    <form action="edit_product.php" method="post">
        <label for="ProductID">ProductID:</label>
        <input type="text" name="ProductID" value="<?= $productDetails['ProductID'] ?>" readonly>

        <label for="ProductName">ProductName:</label>
        <input type="text" name="ProductName" value="<?= htmlspecialchars($productDetails['ProductName']) ?>" required>

        <label for="Description">Description:</label>
        <input type="text" name="Description" value="<?= htmlspecialchars($productDetails['Description']) ?>" required>

        <label for="Price">Price:</label>
        <input type="text" name="Price" value="<?= htmlspecialchars($productDetails['Price']) ?>" required>

        <label for="ImageURL">ImageURL:</label>
        <input type="text" name="ImageURL" value="<?= htmlspecialchars($productDetails['ImageURL']) ?>" required>

        <!-- Final data validation must be performed on the server -->
        <!-- Users can modify code/data in their browser -->
        <!-- For example, they can remove the required attribute or change an email input to a text input -->
        <input type="submit" name="submit" value="Update">
    </form>
</body>
</html>
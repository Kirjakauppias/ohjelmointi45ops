<?php
// Tietokanta yhteyden koodit löytyy tästä tiedostosta
require_once 'includes_admin/db_connection.inc.php'; // <- $pdo_conn
require_once 'includes_admin/product_operations.inc.php';

// Tuotteen "poisto"
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete'])) {
        // delete nappia on painettu
        $productIdToDelete = $_POST["product_id"];
        $operationResult = delete_product($pdo_conn, $productIdToDelete);
    }
}

// Tuotteen "palautus"
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['restore'])) {
        // restore nappia on painettu
        $productIdToRestore = $_POST["product_id"];
        $operationResult = restore_product($pdo_conn, $productIdToRestore);
    }
}

// $queryString = "SELECT * FROM products" // Voi olla myös erillinen muuttuja SQL lauseelle
$stmt = $pdo_conn->prepare("SELECT ProductID, ProductName, Description, Price, ImageURL, deleted_at FROM products");

$stmt->execute(); // Suoritetaan SQL lause
$products = $stmt->fetchAll(PDO::FETCH_ASSOC); // Tallennetaan data muuttujaan
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Products</title>
    <style>
        table {
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
        }

        th {
            background-color: #D2D2D2;
        }

        body {
            display: flex;
            justify-content: center;
        }

        h2 {
            text-align: center;
        }

        .delete {
            background-color: #f5514e;
            font-weight: bold;
            padding: 15px;
            border-radius: 15px;
            cursor: pointer;
            width: 80px;
        }

        .restore {
            background-color: #8CED28;
            font-weight: bold;
            padding: 15px;
            border-radius: 15px;
            cursor: pointer;
            width: 80px;
        }

        form {
            display: inline-flex;
        }

        .divider {
            width: 12px;
            display: inline-flex;
        }

        a {
            display: inline-flex;
        }

        .deleted {
            background-color: #FFD2D2;
        }

        .hidden {
            opacity: 0;
        }
    </style>
</head>
<body>
    <main>
        <a href="admin_login.php">Takaisin pääsivulle</a>

        <h3 <?php if (isset($operationResult) === false) { echo "class='hidden'"; } ?>>
            <?php if (isset($operationResult)) { echo $operationResult; } else { echo "hidden"; }?>
        </h3>

        <h2>Product List (vain admin käyttäjät)</h2>

        <!-- Tähän taulukkoon generoidaan rivejä $products muuttujan datan perusteella -->
        <table>
            <!-- Otsikko rivi -->
            <tr>
                <th>ID</th>
                <th>Product Name</th>
                <th>Description</th>
                <th>Price</th>
                <th>Image URL</th>
                <th>Actions</th>
            </tr>
            <!-- Loopataan läpi $products array ja generoidaan rivejä taulukkoon -->
            <?php foreach ($products as $product): ?>
                <tr <?php if ($product['deleted_at'] !== null) echo "class='deleted'"; ?>>
                    <td><?= $product["ProductID"] ?></td>
                    <td><?= htmlspecialchars($product["ProductName"]) ?></td>
                    <td><?= htmlspecialchars($product["Description"]) ?></td>
                    <td><?= $product["Price"] ?></td>
                    <td><?= htmlspecialchars($product["ImageURL"]) ?></td>
                    <td>
                        <?php if ($product['deleted_at'] === null): ?>
                            <!-- Poistetaan tuote tällä sivulla -->
                            <form action="view_products.php" method="post">
                                <input type="hidden" name="product_id" value="<?= $product["ProductID"] ?>">
                                <button class="delete" name="delete" type="submit">Delete</button>
                            </form>
                        <?php else: ?>
                            <form action="view_products.php" method="post">
                                <input type="hidden" name="product_id" value="<?= $product["ProductID"] ?>">
                                <button class="restore" name="restore" type="submit">Restore</button>
                            </form>
                        <?php endif; ?>

                        <div class="divider"></div>

                        <!-- $_GET["ProductID"] -->
                        <a href="edit_product.php?ProductID=<?= $product["ProductID"] ?>">Edit</a>

                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </main>
</body>
</html>
<?php
// Tietokanta yhteyden koodit löytyy tästä tiedostosta
require_once 'includes_admin/db_connection.inc.php'; // <- $pdo_conn
require_once 'includes_admin/order_operations.inc.php';

// Tilausten "poisto"
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['delete'])) {
        // delete nappia on painettu
        $orderIdToDelete = $_POST["order_id"];
        $operationResult = delete_order($pdo_conn, $orderIdToDelete);
    }
}

// Tilausten "palautus"
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['restore'])) {
        // restore nappia on painettu
        $orderIdToRestore = $_POST["order_id"];
        $operationResult = restore_order($pdo_conn, $orderIdToRestore);
    }
}

if($_SERVER['REQUEST_METHOD'] === 'POST') {
    if(isset($_POST['admin_order_status'])) {

        $orderStatus = [
            'OrderID' => $_POST['orderid'],
            'Status' => $_POST['status'],];

            $sql = "UPDATE orders SET Status = :Status WHERE OrderID = :OrderID";

            $stmt = $pdo_conn->prepare($sql);
    
            // Bind parameters
            $stmt->bindParam(':OrderID', $orderStatus['OrderID']);
            $stmt->bindParam(':Status', $orderStatus['Status']);

        //Execute the query
        if($stmt->execute()) {
            echo "Tilauksen status muutettu onnistuneesti!<br>";
        } else {
            echo "Error: " . $stmt->errorInfo()[2];
        }
    }
}

// $queryString = "SELECT * FROM orders" // Voi olla myös erillinen muuttuja SQL lauseelle
$stmt = $pdo_conn->prepare("SELECT OrderID, UserID, OrderDate, Status, TotalPrice, deleted_at FROM orders");

$stmt->execute(); // Suoritetaan SQL lause
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC); // Tallennetaan data muuttujaan
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Orders</title>
    <style>
        table {
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid black;
            padding: 8px;
            
        }        

        th {
            background-color: #D2D2D2
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
            <?php if (isset($operationResult)) { echo $operationResult; } else { echo "hidden";} ?>
        </h3>
        
        <h2>Order List</h2>
        
        <!-- Tähän taulukkoon generoidaan rivejä $orders muuttujan datan perusteella -->
        <table>
            <!-- Otsikko rivi -->
            <tr>
                <th>OrderID</th>
                <th>UserID</th>
                <th>OrderDate</th>
                <th>Status</th>
                <th>TotalPrice</th>
                <th>Actions</th>
            </tr>
            <!-- Loopataan läpi $orders array ja generoidaan rivejä taulukkoon -->
            <?php foreach ($orders as $order): ?>
                <tr <?php if ($order['deleted_at'] !== null) echo "class='deleted'"; ?>>
                    <td><?= $order["OrderID"] ?></td>
                    <td><?= $order["UserID"] ?></td>
                    <td><?= $order["OrderDate"] ?></td>
                    <td><?= $order["Status"] ?></td>
                    <td><?= $order["TotalPrice"] ?></td>
                    <td>
                        <?php if ($order['deleted_at'] === null): ?>
                            <!-- Poistetaan tilaus tällä sivulla -->
                            <form action="view_orders.php" method="post">
                                <input type="hidden" name="order_id" value="<?= $order["OrderID"] ?>">
                                <button class="delete" name="delete" type="submit">Delete</button>
                            </form>
                        <?php else: ?>
                            <form action="view_orders.php" method="post">
                                <input type="hidden" name="order_id" value="<?= $order["OrderID"] ?>">
                                <button class="restore" name="restore" type="submit">Restore</button>
                            </form>
                        <?php endif; ?>

                        <div class="divider"></div>

                        <a href="edit_order.php?OrderID=<?= $order["OrderID"] ?>">Edit</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
        <h3>Muokkaa tilauksen statusta</h3>

        <form action="" method="post">
                <input type="text" name="orderid" placeholder="Order ID"><br>
                <input type="text" name="status" placeholder="Tilauksen status"><br>
            <button name="admin_order_status">Lähetä</button>
        </form>
    </main>
</body>
</html>
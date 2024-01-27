<?php
// Tietokanta yhteyden koodit löytyy tästä tiedostosta
require_once 'includes_admin/db_connection.inc.php'; // <- $pdo_conn
require_once 'includes_admin/order_operations.inc.php';

// Fetch orderitems data
$stmtOrderItems = $pdo_conn->prepare("SELECT OrderItemID, OrderID, ProductID, Quantity, Subtotal FROM orderitems");
$stmtOrderItems->execute();
$orderItems = $stmtOrderItems->fetchAll(PDO::FETCH_ASSOC);
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
<!-- Additional HTML for orderitems table -->
<h2>Order Items List</h2>

<table>
    <tr>
        <th>OrderItemID</th>
        <th>OrderID</th>
        <th>ProductID</th>
        <th>Quantity</th>
        <th>Subtotal</th>
    </tr>

    <?php foreach ($orderItems as $orderItem): ?>
        <tr>
            <td><?= $orderItem["OrderItemID"] ?></td>
            <td><?= $orderItem["OrderID"] ?></td>
            <td><?= $orderItem["ProductID"] ?></td>
            <td><?= $orderItem["Quantity"] ?></td>
            <td><?= $orderItem["Subtotal"] ?></td>
        </tr>
    <?php endforeach; ?>
</table>
</main>
</body>
</html>
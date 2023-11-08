<?php
    session_start();

    // Tietokanta yhteys
    // Palvelin, tietokanta, tunnukset palvelimelle (user, password)
    $servername = "localhost";
    $databasename = "verkkokauppa";
    $username = "root";
    $password = "";

    //Yritetään
    try {
        //Luodaan yhteys, joka on PDO objekti
        $conn = new PDO("mysql:host=$servername;dbname=$databasename", $username, $password);

        //PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //Valmistellaan kysely
        $users_kysely = $conn->prepare("SELECT * FROM users");
        $products_kysely = $conn->prepare("SELECT * FROM products");
        $orders_kysely = $conn->prepare("SELECT * FROM orders");
        $order_items_kysely = $conn->prepare("SELECT * FROM orderitems");

        //Suoritetaan kysely
        $users_kysely->execute();
        $products_kysely->execute();
        $orders_kysely->execute();
        $order_items_kysely->execute();
    }
    catch (PDOException $e) {
        // Yhteys epäonnistui
        echo "Connection failed". $e->getMessage();
    }
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<h2>Users</h2>
<table border="1">
    <tr>
        <th>User ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Email</th>
        <th>Address</th>
        <th>User Type</th>
    </tr>
        <?php
            while($rivi = $users_kysely->fetch()) {
                echo "<tr>";
                echo "<td>" . $rivi["UserID"] . "</td>";
                echo "<td>" . $rivi["FirstName"] . "</td>";
                echo "<td>" . $rivi["LastName"] . "</td>";
                echo "<td>" . $rivi["Email"] . "</td>";
                echo "<td>" . $rivi["Address"] . "</td>";
                echo "<td>" . $rivi["UserType"] . "</td>";
            }
        ?>
</table>

    <h2>Products</h2>
<table border="1">
    <tr>
        <th>Product ID</th>
        <th>Product Name</th>
        <th>Description</th>
        <th>Price</th>
        <th>Image</th>
    </tr>
    <?php
            while($rivi = $products_kysely->fetch()) {
                echo "<tr>";
                echo "<td>" . $rivi["ProductID"] . "</td>";
                echo "<td>" . $rivi["ProductName"] . "</td>";
                echo "<td>" . $rivi["Description"] . "</td>";
                echo "<td>" . $rivi["Price"] . "</td>";
                //echo "<td>" . $rivi["Image"] . "</td>";
            }
        ?>
</table>

<h2>Orders</h2>
<table border="1">
    <tr>
        <th>Order ID</th>
        <th>User ID</th>
        <th>Order Date</th>
        <th>Status</th>
        <th>Total Price</th>
    </tr>
    <?php
            while($rivi = $orders_kysely->fetch()) {
                echo "<tr>";
                echo "<td>" . $rivi["OrderID"] . "</td>";
                echo "<td>" . $rivi["UserID"] . "</td>";
                echo "<td>" . $rivi["OrderDate"] . "</td>";
                echo "<td>" . $rivi["Status"] . "</td>";
                echo "<td>" . $rivi["TotalPrice"] . "</td>";
            }
        ?>
</table>

<h2>Order Items</h2>
<table border="1">
    <tr>
        <th>Order Item ID</th>
        <th>Order ID</th>
        <th>Product ID</th>
        <th>Quantity</th>
        <th>Subtotal</th>
    </tr>
    <?php
            while($rivi = $order_items_kysely->fetch()) {
                echo "<tr>";
                echo "<td>" . $rivi["OrderItemID"] . "</td>";
                echo "<td>" . $rivi["OrderID"] . "</td>";
                echo "<td>" . $rivi["ProductID"] . "</td>";
                echo "<td>" . $rivi["Quantity"] . "</td>";
                echo "<td>" . $rivi["Subtotal"] . "</td>";
            }
        ?>
</table>
</body>
</html>
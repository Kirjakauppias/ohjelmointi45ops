<?php

function createCartItem($productInfo) {
    return [
        "productID" => $productInfo["ProductID"],
        "productName" => $productInfo["ProductName"],
        "price" => $productInfo["Price"],
        "quantity" => 1, //Oletuksena 1
        //"userID" => $loggedInUserID,
    ];
}
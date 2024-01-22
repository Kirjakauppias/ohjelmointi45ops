<?php

declare(strict_types=1);

function get_user(object $pdo, string $username) {
    $query = "SELECT * FROM users WHERE username= :username";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(":username", $username);
    $stmt->execute();

    $result = $stmt->fetch(PDO::FETCH_ASSOC);

    return $result; 
}

function getUserInfo(object $pdo, int $userID) {
    $query = "SELECT * FROM users WHERE UserID = :user_id";
    $stmt = $pdo->prepare($query);
    $stmt->bindParam(':user_id, $userId, PDO::PARAM_INT');
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}
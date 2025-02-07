<?php
//TIEDOSTO JOSSA TARKISTETAAN KIRJAUTUMISLOMAKKEEN SYÖTTEITÄ
declare(strict_types=1);

//bool|array syntaksi hyväksyy argumenttina joko boolean tai array datatyypit.

function is_username_wrong(bool|array $result) {
    if ($result == false) {
        return true;
    } else {
        return false;
    }
}
function is_password_wrong(string $password, string $hashedPassword) {
    if (password_verify($password, $hashedPassword) == false) {
        return true;
    } else {
        return false;
    }
}
function is_input_empty(string $username, string $password) {
    if (empty($username) || empty($password)) {
        return true;
    } else {
        return false;
    }
}
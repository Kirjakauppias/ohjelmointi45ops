<?php
function includeUpperElements(){
    include 'partials/doc.php';                      //HTML -sivun alkukoodi on täällä.
    include 'partials/header.php';                   //Otsikko -tason koodi on täällä.
    include 'partials/nav.php';                      //Navigointi -koodi on täällä.
    echo "<main>";
}
function includeBottomElements(){
    echo "</main>";
    include 'partials/footer.php';
    include 'scripts/navScript.php';
    include 'partials/htmlEnd.php';
}

function createUpdateForm() {
    echo "
        <form method='post' action='' class='form-container'>
            <label for='firstname'>Etunimi:</label>
            <input type='text' name='firstname' value='{$_SESSION['firstname']}'><br>
            <label for='lastname'>Sukunimi:</label>
            <input type='text' name='lastname' value='{$_SESSION['lastname']}'><br>
            <label for='address'>Osoite:</label>
            <input type='text' name='address' value='{$_SESSION['address']}'><br>
            <label for='username'>Käyttäjätunnus:</label>
            <input type='text' name='username' value='{$_SESSION['username']}'><br>
            <label for='new_password'>Uusi salasana:</label>
            <input type='password' name='new_password'><br>
            <label for='confirm_password'>Vahvista salasana:</label>
            <input type='password' name='confirm_password'><br>

            <input type='submit' value='Tallenna'>
        </form>
    ";
}

function printUserDetails() {
    echo "Käyttäjätunnus: " . $_SESSION['username'] . "<br>";
    echo "Email: " . $_SESSION['email'] . "<br>";
    echo "Etunimi: " . $_SESSION['firstname'] . "<br>";
    echo "Sukunimi: " . $_SESSION['lastname'] . "<br>";
    echo "Osoite: " . $_SESSION['address'] . "<br>";
}
<?php
function createUpdateForm($userDetails) {
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
function printUserDetails($userDetails) {
    echo "<p>Käyttäjätunnus:<b> " . $userDetails['Username'] . "</b></p><br>";
    echo "<p>Etunimi:<b> " . $userDetails['FirstName'] . "</b></p><br>";
    echo "<p>Sukunimi:<b> " . $userDetails['LastName'] . "</b></p><br>";
    echo "<p>Osoite:<b> " . $userDetails['Address'] . "</b></p><br>";
    echo "<p>E-mail:<b> " . $userDetails['Email'] . "</b></p><br>";
}

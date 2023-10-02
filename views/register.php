<h2>User Registration</h2>
<form method="POST">
    <label for="nome">Nome:</label>
    <input type="text" name="nome" required><br>

    <label for="cognome">Cognome:</label>
    <input type="text" name="cognome" required><br>

    <label for="email">Email:</label>
    <input type="email" name="email" required><br>

    <label for="password">Password:</label>
    <input type="password" name="password" required><br>

    <input type="submit" value="Register">
</form>

<?php

use Dao\UserDAO;

require "Dao/UserDAO.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get user input from the form
    $name = $_POST['nome'];
    $lastname = $_POST['cognome'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // create return true if success, else return false
    $userCreated = UserDAO::create($name, $lastname, $email, $password);

    if ($userCreated) {
        // success, redirect to same page
        header("Location: register");
    }
}

?>
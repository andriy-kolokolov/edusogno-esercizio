<h2>User Registration</h2>
<form method="POST">
    <label for="nome">Nome:</label>
    <input type="text" name="name" required><br>

    <label for="cognome">Cognome:</label>
    <input type="text" name="lastname" required><br>

    <label for="email">Email:</label>
    <input type="email" name="email" required><br>

    <label for="password">Password:</label>
    <input type="password" name="password" required><br>

    <input type="submit" value="Register">
</form>

<?php

use Dao\UserDAOImpl;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // get user input from the form
    $name = $_POST['name'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // return true if success, else return false
    $userDao = new UserDAOImpl();
    $userCreated = $userDao->create($name, $lastname, $email, $password);

    if ($userCreated) {
        header("Location: dashboard");
    } else {
        echo '<div style="color: crimson">User with this email already exists :(</div>';
    }
}
?>
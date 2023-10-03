<h2>User Login</h2>
<form method="POST">
    <label for="email">Email:</label>
    <input type="email" name="email" required><br>

    <label for="password">Password:</label>
    <input type="password" name="password" required><br>

    <input type="submit" value="Login">
</form>

<?php

use Dao\UserDAOImpl;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // validate user
    $userDao = new UserDAOImpl();
    $isValidUser = $userDao->validateUser($email, $password);

    if ($isValidUser) {
        // If success redirect to dashboard
        header("Location: dashboard");
    } else {
        echo '<div style="color: crimson">Invalid email or password. Please try again.</div>';
    }
}
?>
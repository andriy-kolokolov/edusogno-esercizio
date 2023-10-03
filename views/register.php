<?php
if (isset($_SESSION['login_status'])) {
    $loginStatus = htmlspecialchars($_SESSION['login_status']);
    $loginMessage = htmlspecialchars($_SESSION['login_message']);
    // clean session login data from $_SESSION
    unset($_SESSION['login_message']);
    unset($_SESSION['login_status']);
}
?>

<h2>User Registration</h2>

<?php
// render alert if registration fails
if ($loginStatus == "fail"){
    echo '<div class="alert alert-fail" style="color: crimson">' . htmlspecialchars($loginMessage) . '</div>';
}
?>

<form action="auth/register" method="POST">
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

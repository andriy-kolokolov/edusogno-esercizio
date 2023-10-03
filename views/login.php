<?php
if (isset($_SESSION['login_status'])) {
    $loginStatus = htmlspecialchars($_SESSION['login_status']);
    $loginMessage = htmlspecialchars($_SESSION['login_message']);
    // clean session login data from $_SESSION
    unset($_SESSION['login_message']);
    unset($_SESSION['login_status']);
}
?>

<h2>User Login</h2>

<?php
// render alert if login fails
if ($loginStatus == "fail"){
    echo '<div class="alert alert-fail" style="color: crimson">' . htmlspecialchars($loginMessage) . '</div>';
}
?>

<form action="auth/login" method="POST">
    <label for="email">Email:</label>
    <input type="email" name="email" required><br>

    <label for="password">Password:</label>
    <input type="password" name="password" required><br>

    <input type="submit" value="Login">
</form>
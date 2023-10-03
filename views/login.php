<?php

use Util\Auth;

if (isset($_SESSION['login_status'])) {
    $loginStatus = htmlspecialchars($_SESSION['login_status']);
    unset($_SESSION['login_status']);
}
?>

<?php if ($loginStatus == "fail") { ?>
    <div class="alert alert-fail">
        <div class="alert__message">Credentials don't match our records..</div>
    </div>
<?php } ?>

<div class="page-content">
    <h2>User Login</h2>
    <form action="auth/login" method="POST">
        <label for="email">Email:</label>
        <input type="email" name="email" required><br>

        <label for="password">Password:</label>
        <input type="password" name="password" required><br>

        <input type="submit" value="Login">
    </form>
</div>
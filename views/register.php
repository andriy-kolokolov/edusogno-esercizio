<?php
if (isset($_SESSION['login_status'])) {
    $loginStatus = htmlspecialchars($_SESSION['login_status']);
    $existingEmail = htmlspecialchars($_SESSION['existing_email']);
    unset($_SESSION['login_status']);
    unset($_SESSION['existing_email']);
}
?>



<?php if ($loginStatus == "fail") { ?>
    <div class="alert alert-fail">
        <div class="alert__message">User with email "' . $existingEmail . '" already exists, try another one :)</div>
    </div>
<?php } ?>

<div class="page-content">
    <h2>User Registration</h2>
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
</div>

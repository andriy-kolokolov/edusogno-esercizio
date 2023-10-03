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
        <div class="alert__message">User with email '<?php echo $existingEmail; ?>' already exists, try another one.
        </div>
    </div>
<?php } ?>

<div class="page-content">
    <h2 class="page-title">User Registration</h2>

    <form class="form" action="auth/register" method="POST">
        <label class="form-label" for="name">Name:</label>
        <input class="form-input" id="name" type="text" name="name" placeholder="Name" required>

        <label class="form-label" for="lastname">Lastname:</label>
        <input class="form-input" id="lastname" type="text" name="lastname" placeholder="Lastname" required>

        <label class="form-label" for="email">Email:</label>
        <input class="form-input" id="email" type="email" name="email" placeholder="Email" required>

        <label class="form-label" for="password">Password:</label>
        <input class="form-input" id="password" type="password" name="password" placeholder="Password" required>

        <div class="btn-wrap">
            <input class="btn btn-primary" type="submit" value="Register">
        </div>
    </form>
</div>

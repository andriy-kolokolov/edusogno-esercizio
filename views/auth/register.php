<?php
$loginStatus = $_SESSION['login_status'] ?? null;
$existingEmail = $_SESSION['existing_email'] ?? null;
unset($_SESSION['login_status']);
unset($_SESSION['existing_email']);
?>

<div class="page-content">
    <div class="form-wrapper">
        <form id="form-submit" class="form" action="auth/register" method="POST">
            <h2 class="form-title">User Registration</h2>
            <?php if ($loginStatus == "fail") { ?>
                <div class="form-group">
                    <div class="alert alert-fail">
                        <div class="alert__message">User with email '<?php echo $existingEmail; ?>' already exists, try
                            another one.
                        </div>
                    </div>
                </div>
            <?php } ?>
            <div class="form-group">
                <input class="form-input" id="name" type="text" name="name" placeholder="Name" required>
                <label class="form-label" for="name">Name</label>
            </div>
            <div class="form-group">
                <input class="form-input" id="lastname" type="text" name="lastname" placeholder="Lastname" required>
                <label class="form-label" for="lastname">Lastname</label>
            </div>
            <div class="form-group">
                <input class="form-input" id="email" type="email" name="email" placeholder="Email" required>
                <label class="form-label" for="email">Email</label>
            </div>
            <div class="form-group">
                <input class="form-input" id="password" type="password" name="password" placeholder="Password" required>
                <label class="form-label" for="password">Password</label>
            </div>
            <div class="form-group">
                <div class="form-buttons d-flex justify-between">
                    <a class="btn btn-primary" href="/login">Go to Log In</a>
                    <button id="btn-submit" class="btn btn-primary" type="submit">
                        <span>Register</span>
                    </button>
                </div>
            </div>
        </form>
    </div>

    <script src="../../assets/js/formSubmit.js"></script>
</div>

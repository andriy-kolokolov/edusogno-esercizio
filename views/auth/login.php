<?php
$loginStatus = $_SESSION['login_status'] ?? null;
$resetPasswordStatus = $_SESSION['reset-password-status'] ?? null;
unset($_SESSION['login_status']);
unset($_SESSION['reset-password-status']);
?>


<div class="page-content">
    <div class="form-wrapper">
        <form id="form-submit" class="form" action="auth/login" method="POST">
            <h2 class="form-title">User Login</h2>
            <?php if ($loginStatus == "fail") { ?>
                <div class="form-group">
                    <div class="alert alert-fail">
                        <div class="alert__message">Credentials don't match our records..</div>
                    </div>
                </div>
            <?php } ?>
            <?php if ($resetPasswordStatus == "success") { ?>
                <div class="form-group">
                    <div class="alert alert-success">
                        <div class="alert__message">Password reset successfully!</div>
                    </div>
                </div>
            <?php } ?>
             <?php if ($resetPasswordStatus == "fail") { ?>
                <div class="form-group">
                    <div class="alert alert-fail">
                        <div class="alert__message">Error occurred resetting password.</div>
                    </div>
                </div>
            <?php } ?>
            <div class="form-group">
                <input class="form-input" id="email" type="email" name="email" required placeholder="Email">
                <label class="form-label" for="email">Email:</label>
            </div>
            <div class="form-group">
                <input class="form-input" id="password" type="password" name="password" placeholder="Password" required>
                <label class="form-label" for="password">Password:</label>
            </div>
            <div class="form-group">
                <div class="form-buttons d-flex justify-between">
                    <a class="btn btn-primary" href="/register">Register account</a>
                    <input class="btn btn-primary" type="submit" value="Login">
                </div>
            </div>
            <div class="form-group">
                <div class="form-buttons d-flex justify-between gap-3">
                    <a class="" href="/reset-password">Forgot your password?</a>
                </div>
            </div>
        </form>
    </div>
</div>
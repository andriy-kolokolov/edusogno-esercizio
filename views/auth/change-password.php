<?php

use Dao\UserDAOImpl;

$token = $_SESSION['reset-password-token'] ?? null;

$userDao = new UserDAOImpl();
$isValidToken = $userDao->getUserByPasswordResetToken($token);

?>

<div class="page-content">
    <div class="form-wrapper">
        <?php if ($isValidToken) { ?>
            <form class="form form-submit" action="auth/change-password" method="POST">
                <h2 class="form-title">Reset password</h2>
                <div class="form-group">
                    <input class="form-input" id="new-password" type="password" name="new_password" placeholder="New Password" required>
                    <label class="form-label" for="new-password">New Password</label>
                </div>
                <div class="form-group">
                    <div class="form-buttons center">
                        <button class="btn btn-submit btn-primary" type="submit">
                            <span>Reset Password</span>
                        </button>
                    </div>
                </div>
            </form>
        <?php } else { // No valid reset token provided ?>
            <p>Invalid or missing reset password token.</p>
        <?php } ?>
    </div>
</div>
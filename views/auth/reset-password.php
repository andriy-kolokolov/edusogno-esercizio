<?php

use Util\Auth;

$emailSent = $_SESSION['email-sent-status'] ?? null;
$notExistingEmail = $_SESSION['not-existing-email'] ?? null;
unset($_SESSION['email-sent-status']);
unset($_SESSION['not-existing-email']);
?>

<div class="page-content">
    <div class="form-wrapper">
        <form id="form-submit" class="form" action="auth/reset-password" method="post">

            <h2 class="form-title">Reset password</h2>
            <?php if ($emailSent == "fail") { ?>
                <div class="form-group">
                    <div class="alert alert-fail">
                        <div class="alert__message">
                            Email sending fail..
                        </div>
                    </div>
                </div>
            <?php } ?>
            <?php if ($emailSent == "success") { ?>
                <div class="form-group">
                    <div class="alert alert-success">
                        <div class="alert__message">
                            Email with password restore link was sent successfully.
                        </div>
                    </div>
                </div>
            <?php } ?>

            <?php if (Auth::user()) { ?>
                <div class="form-group align-center flex-column gap-2">
                    <div>Send restore password link to: </div>
                    <div class="text-info badge badge-email"><?php echo Auth::user()->getEmail() ?? null; ?></div>
                </div>
                <div class="form-group">
                    <input type="hidden" value="<?php echo Auth::user()->getEmail() ?? null; ?>" class="form-input" id="email" name="email" required>
                </div>
            <?php } else { ?>
                <div class="form-group">
                    <input class="form-input" id="email" type="email" name="email" placeholder="Email" required>
                    <label class="form-label" for="email">Email</label>
                </div>
            <?php } ?>

            <div class="form-group d-flex justify-center">
                <div class="form-buttons">
                    <button id="btn-submit" class="btn btn-primary d-flex gap-2 align-center" type="submit">
                        <span>Send reset password link</span>
                    </button>
                </div>
            </div>
        </form>
    </div>
    <script src="../../assets/js/formSubmit.js"></script>
</div>

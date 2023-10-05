<?php
$emailSent = $_SESSION['email-sent-status'] ?? null;
$notExistingEmail = $_SESSION['not-existing-email'] ?? null;
unset($_SESSION['email-sent-status']);
unset($_SESSION['not-existing-email']);
?>

<div class="page-content">
    <div class="form-wrapper">
        <form id="form-submit" class="form" action="auth/reset-password" method="POST">
            <h2 class="form-title">Reset password</h2>
            <?php if ($emailSent == "fail") { ?>
                <div class="form-group">
                    <div class="alert alert-fail">
                        <div class="alert__message">
                            Email '<?php echo $notExistingEmail; ?>' not found..
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
            <div class="form-group">
                <input class="form-input" id="email" type="email" name="email" placeholder="Email" required>
                <label class="form-label" for="email">Email</label>
            </div>
            <div class="form-group">
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

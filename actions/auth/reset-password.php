<?php

use Util\Mailer;

if (isset($_POST['email'])) {
    $resetPasswordEmail = $_POST['email'];

    Mailer::sendRestorePasswordLink($resetPasswordEmail);

    header("Location: /reset-password");
}
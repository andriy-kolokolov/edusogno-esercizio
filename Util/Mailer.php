<?php

namespace Util;

use Dao\UserDAOImpl;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/phpmailer/phpmailer/src/Exception.php';
require 'vendor/phpmailer/phpmailer/src/PHPMailer.php';
require 'vendor/phpmailer/phpmailer/src/SMTP.php';

class Mailer
{

    const EMAIL_SENT_FAIL = 'fail';
    const EMAIL_SENT_SUCCESS = 'success';

    public static function sendRestorePasswordLink(string $email): bool
    {
        $userDao = new UserDAOImpl();
        $user = $userDao->getByEmail($email);
        if (!$user) { // if user with 'email' not exists
            $_SESSION['email-sent-status'] = self::EMAIL_SENT_FAIL;
            $_SESSION['not-existing-email'] = $email;
            return false;
        }

        $token = Auth::generatePasswordResetToken($user);

        $mail = new PHPMailer();
        try {
            $mail->IsSMTP();
            $mail->Mailer = "smtp";
            $mail->SMTPDebug = 1;
            $mail->SMTPAuth = TRUE;
            $mail->SMTPSecure = "tls";
            $mail->Port = 587;
            $mail->Host = "smtp.gmail.com";
            $mail->Username = "";  // EMAIL
            $mail->Password = ""; // APP PASSWORD

            // Sender and recipient
            $mail->SetFrom("no-reply@edusogno.com", "Edusogno");
            $mail->AddAddress($user->getEmail(), $user->getName() . ' ' . $user->getLastname()); // TO
            // Email content
            $mail->IsHTML(true);
            $mail->Subject = "Edusogno Password Reset Link";
            $resetLink = "localhost/change-password?reset-password-token=$token";
            $content = "Click the following link to reset your password: <a href='http://$resetLink'>$resetLink</a>";
            $mail->Body = $content;

            if (!$mail->Send()) {
                $_SESSION['email-sent-status'] = self::EMAIL_SENT_FAIL;
                echo "Error while sending Email.";
                var_dump($mail);
                return false;
            } else {
                $_SESSION['email-sent-status'] = self::EMAIL_SENT_SUCCESS;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
        return true;
    }
}
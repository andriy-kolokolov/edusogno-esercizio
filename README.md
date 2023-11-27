## Simple Dashboard from scratch using PHP
### For password reset by link reset and sending alerts to attendees set up this:
 - In `Util/Mailer` set your `GOOGLE_EMAIL` and `GOOGLE_APP_PASSWORD`: https://myaccount.google.com/apppasswords?pli=1&rapt=AEjHL4NeyYHdOUZrwnscDxeQdJ78oB_UWXJePYdma5HyoDVBcawKf1thF34e0hDCcM8NSc6QADgTKhavprHjYspoMgwWOOEJPw
 - When creating event, as one of attendees use your mail to test alert for new created or updated events.

### How reset password using `Mailer` works?
- Register using your email.
- User navigate to `/reset-password` page, types `email`, submitting form.
- If `email` exists:
  - `Auth::generatePasswordResetToken($user);` generates token and stores it to database to related `$user`.
  - PHP Mailer sending mail to `$user` email
  - If mail sent successfully redirect back to `/reset-password` with success alert.
- Else if user not find by email, or sending mail fails, it also redirects back to `/reset-password` with fail alert.
- User using received link containing token as parameter, it takes him to `/change-password` page.
- `$userDao->getUserByPasswordResetToken($token);` retrieving user by token. 
- User types new password and submitting.
- Password changed.

### Install:
  - App using PHPMailer, install it using `composer install`
  - In `Util/DbUtil.php` class you must set up your database **_name_**, **_password_**, **_hostname_** and **_db name_**.

## Versions:
- PHP 8.1.0
- MySQL 5.7.24

## Routes:
Actions:
- `auth/register`
- `auth/login`
- `auth/reset-password` 
- `event/create` (admin role only!)
- `event/update` (admin role only!)
- `event/delete` (admin role only!)

Views:
- `/` redirects to `/login` if not authenticated, else redirects to `/dashboard`
- `/register`
- `/login` 
- `/reset-password`
- `/change-password` (only having reset link containing correct token parameter)
- `/dashboard` (authenticated user only)
- `/event-create` (admin role only!)
- `/event-update` (admin role only!)

## Info:
- You can uncomment `include 'config/debug.php'` in **_index.php_** for debug.
- On first app start database migrations running automatically. App using `$_SESSION` global variable to store migrations status and prevent running migrations if they already were done.
- Using session for user authentication.
- App is using apache server for routing system, and it's redirecting all HTTP requests to the router. For details check: `.htaccess` in root folder.
- App using DAO Pattern to access db data.

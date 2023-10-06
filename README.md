### Install:
  - App using PHPMailer, install it using `composer install`
  - In `Util/DbUtil.php` class you must set up your database **_user name_**, **_password_** and **_hostname_**.

## ! Important !
### To test password reset using reset link:
 - In `Util/Mailer` set your google email and app password: https://myaccount.google.com/apppasswords?pli=1&rapt=AEjHL4NeyYHdOUZrwnscDxeQdJ78oB_UWXJePYdma5HyoDVBcawKf1thF34e0hDCcM8NSc6QADgTKhavprHjYspoMgwWOOEJPw
 - **_Only if db tables non yet exist_**, on first app launch database migrations running automatically.

### How `Mailer` works?
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

## Versions:
- PHP 8.1.0
- MySQL 5.7.24

## Routes:
Actions:
- `auth/register`
- `auth/login`
- `auth/reset-password`
- `event/create`
- `event/update`
- `event/delete`

Views:
- `/` home
- `/register`
- `/login` 
- `/reset-password` 
- `/change-password`
- `/dashboard` (can access if user authenticated)
- `/event-create`
- `/event-update`

## Info:
- You can uncomment `include 'config/debug.php'` in **_index.php_** for debug.
- On first app start database migrations running automatically. App using `$_SESSION` global variable to store migrations status and prevent running migrations if they already were done.
- Using session for user authentication.
- App is using apache server for routing system, and it's redirecting all HTTP requests to the router. For details check: `.htaccess` in root folder.
- App using DAO Pattern to access db data.

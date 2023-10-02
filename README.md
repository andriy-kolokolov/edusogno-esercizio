>> #### ! Important !
> - In `Util/DbUtil.php` class you must set up your database **_name_**, **_password_**, **_hostname_** and **_db name_**. 
> - On first `index.php` visit migrations run automatically. App using `$_SESSION` global variable to store migrations status and prevent running migrations if they already were done.

>> Versions:
> - PHP 8.1.0
> - MySQL 5.7.24

>> Info:
> - App is using apache server for routing system, and it's redirecting all HTTP requests to the router. For details check: `.htaccess` in root folder.
> - App using DAO Pattern to access db data

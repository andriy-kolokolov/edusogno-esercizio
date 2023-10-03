<?php

use Util\Auth;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    Auth::logout();
    header("Location: /login"); // Redirect to the login page
    exit();
}

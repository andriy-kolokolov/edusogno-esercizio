<?php
require_once 'autoload.php'; // to automate use of 'require' where needed
session_start();

if (!isset($_SESSION['migrations_completed'])) {
    \Util\DbUtil::runMigrations();
    // Set a session variable to indicate that migrations have been completed
    $_SESSION['migrations_completed'] = true;
}

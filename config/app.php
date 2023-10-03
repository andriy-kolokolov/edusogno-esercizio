<?php
require_once 'autoload.php'; // automate use of 'require' where needed
require_once 'session.php'; // init session

if (!isset($_SESSION['migrations_completed'])) {
    \Util\DbUtil::runMigrations();
    // Set a session variable to indicate that migrations have been completed
    $_SESSION['migrations_completed'] = true;
}

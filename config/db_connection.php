<?php
// Database configuration
$db_host = 'localhost';
$db_username = 'root';
$db_password = 'root';
$db_name = 'edusogno_db';

$db_connection = new mysqli($db_host, $db_username, $db_password, $db_name);

// Check connection
if ($db_connection->connect_error) {
    die("Connection failed: " . $db_connection->connect_error);
}

if ($db_connection) {
    echo "Database connected successfully!";
} else {
    echo "Database connection failed!";
}



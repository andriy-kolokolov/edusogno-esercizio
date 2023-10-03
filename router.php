<?php

$request = $_SERVER['REQUEST_URI'];

switch ($request) {
    /**************************************************
     * VIEW ROUTES
     **************************************************/
    case '':
    case '/':
        require __DIR__ . '/views/index.php';
        break;

    case '/login':
        require __DIR__ . '/views/login.php';
        break;

    case '/register':
        require __DIR__ . '/views/register.php';
        break;

    case '/dashboard':
        require __DIR__ . '/views/dashboard.php';
        break;
    /**************************************************
     * AUTHENTICATION ROUTES
     **************************************************/
    case '/auth/register':
        require __DIR__ . '/actions/auth/register.php';
        break;

    case '/auth/login':
        require __DIR__ . '/actions/auth/login.php';
        break;

    case '/auth/logout':
        require __DIR__ . '/actions/auth/logout.php';
        break;
    /**************************************************
    * OTHER
    **************************************************/
    default:
        http_response_code(404);
        require __DIR__ . '/views/404.php';
        break;
}

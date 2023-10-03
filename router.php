<?php

use Util\Auth;

$request = $_SERVER['REQUEST_URI'];
$authenticatedUser = Auth::user();

switch ($request) {
    /**************************************************
     * VIEW ROUTES
     **************************************************/
    case '':
    case '/':
        require __DIR__ . '/views/index.php';
        break;

    case '/login':
        // Check if the user is authenticated, and if so, redirect to the dashboard
        if ($authenticatedUser) {
            header('Location: /dashboard');
            exit();
        } else {
            require __DIR__ . '/views/login.php';
        }
        break;

    case '/register':
        // Check if the user is authenticated, and if so, redirect to the dashboard
        if ($authenticatedUser) {
            header('Location: /dashboard');
            exit();
        } else {
            require __DIR__ . '/views/register.php';
        }
        break;

    case '/dashboard':
        // check if the user is authenticated before allowing access
        if ($authenticatedUser) {
            require __DIR__ . '/views/dashboard.php';
        } else {
            // redirect the user to the login page if not authenticated
            header('Location: /login');
            exit();
        }
        break;
    /**************************************************
     * AUTHENTICATION ACTION ROUTES
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

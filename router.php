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
            require __DIR__ . '/views/auth/login.php';
        }
        break;

    case '/reset-password':
        require __DIR__ . '/views/auth/reset-password.php';
        break;

    case '/register':
        // Check user auth, authenticated users can't register, redirect to the dashboard
        if ($authenticatedUser) {
            header('Location: /dashboard');
            exit();
        } else {
            require __DIR__ . '/views/auth/register.php';
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

    case '/edit-profile':
        if ($authenticatedUser) {
            require __DIR__ . '/views/edit-profile.php';
        } else {
            // redirect the user to the login page if not authenticated
            header('Location: /login');
            exit();
        }
        break;

    case '/event-create':
        if ($authenticatedUser) {
            require __DIR__ . '/views/event/create.php';
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

    case '/auth/reset-password':
        require __DIR__ . '/actions/auth/reset-password.php';
        break;

    case '/auth/change-password':
        require __DIR__ . '/actions/auth/change-password.php';
        break;

    case '/event/store':
        if ($authenticatedUser) {
            require __DIR__ . '/actions/event/store.php';
        } else {
            // redirect the user to the login page if not authenticated
            header('Location: /login');
            exit();
        }
        break;
    /**************************************************
     * Handling URLs with a "token" parameter
     *************************************************/
    default:
        // check if request contains a "token" parameter
        $query = parse_url($request, PHP_URL_QUERY);
        parse_str($query, $params);

        if (isset($params['reset-password-token'])) {
            $_SESSION['reset-password-token'] = $params['reset-password-token'];
            require __DIR__ . '/views/auth/change-password.php';
        } else {
            http_response_code(404);
            require __DIR__ . '/views/404.php';
        }
        break;
}

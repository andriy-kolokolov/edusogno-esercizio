<h1>DASHBOARD VIEW</h1>
<?php
if (isset($_SESSION['login_status'])) {
    $loginStatus = htmlspecialchars($_SESSION['login_status']);
    $loginMessage = htmlspecialchars($_SESSION['login_message']);
    // clean session login data from $_SESSION
    if ($loginStatus == "success") {
        echo '<div style="color: #9ACD32">' . htmlspecialchars($loginMessage) . '</div>';
    }
    unset($_SESSION['login_message']);
    unset($_SESSION['login_status']);
}
?>
<?php
// render links based on user auth status
$authenticated = isset($_SESSION['user_id']);
?>
<header>
    <div class="container">
        <h1>Edusogno</h1>
        <nav>
            <ul>
                <li><a href="/">Home</a></li>
                <li><a href="/login">Log In</a></li>
                <li><a href="/register">Register</a></li>
                <li><a href="/dashboard">Dashboard</a></li>
            </ul>
        </nav>
    </div>
</header>
<?php

use Util\Auth;

?>
<header>
    <div class="container">
        <h1>Edusogno</h1>
        <nav>
            <ul>
                <li><a href="/">Home</a></li>
                <?php if (Auth::user()) { ?>
                    <li><a href="/dashboard">Dashboard</a></li>
                    <li>
                        <form action="auth/logout" method="post">
                            <input type="submit" name="logout" value="Logout">
                        </form>
                    </li>
                <?php } else { ?>
                    <li><a href="/login">Log In</a></li>
                    <li><a href="/register">Register</a></li>
                <?php } ?>
            </ul>
        </nav>
    </div>
</header>
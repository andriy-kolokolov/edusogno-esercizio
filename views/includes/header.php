<?php

use Util\Auth;

?>
<header class="header">
    <div class="header__container">
        <div class="header__logo-wrapper">
            <img class="logo-wrapper__img" src="../../assets/img/logo.png" alt="logo image">
        </div>
        <nav class="header__nav">
            <ul class="nav__list">
                <li class="list__item">
                    <a class="item__link" href="/">Home</a>
                </li>
                <!-- Authenticated user navigation -->
                <?php if (Auth::user()) { ?>
                    <li class="list__item">
                        <a class="item__link" href="/dashboard">Dashboard</a>
                    </li>
                    <li class="list__item">
                        <form class="item__logout-form" action="auth/logout" method="post">
                            <input type="submit" name="logout" value="Logout">
                        </form>
                    </li>
                <?php } else { ?>
                    <!-- Not authenticated user navigation -->
                    <li class="list__item">
                        <a class="item__link" href="/login">Log In</a>
                    </li>
                    <li class="list__item">
                        <a class="item__link" href="/register">Register</a>
                    </li>
                <?php } ?>
            </ul>
        </nav>
    </div>
</header>
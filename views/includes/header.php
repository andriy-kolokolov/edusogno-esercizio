<?php

use Util\Auth;

?>
<header class="header">
    <div class="header__container">
        <a href="/dashboard" class="header__logo-wrapper">
            <img class="logo-wrapper__img" src="../../assets/img/logo.png" alt="logo image">
        </a>
        <nav class="header__nav">
            <ul class="nav__list">
                <!-- Authenticated user navigation -->
                <?php if (Auth::user()) { ?>
                    <li class="list__item">
                        <a class="item__link" href="/dashboard">Dashboard</a>
                    </li>
                    <li class="list__item">
                        <a class="item__link" href="/edit-profile">Edit Profile</a>
                    </li>
                    <li class="list__item">
                        <form class="form-submit" action="auth/logout" method="post">
                            <button id="btn-logout" class="btn btn-submit btn-sm btn-danger" type="submit" name="logout">
                                <span>Logout</span>
                            </button>
                        </form>
                    </li>
                <?php } else { ?>
                    <!-- Not authenticated user navigation -->
                    <li class="list__item">
                        <a class="item__link" href="/">Home</a>
                    </li>
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
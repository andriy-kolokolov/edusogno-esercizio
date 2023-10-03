<h1>DASHBOARD VIEW</h1>
<?php

use Util\Auth;

if (isset($_SESSION['login_status'])) {
    $loginStatus = htmlspecialchars($_SESSION['login_status']);
    unset($_SESSION['login_status']);
}

if ($loginStatus == "success") {
    echo '<div class="alert alert-success">';
    echo '<div class="alert__message">Welcome to dashboard, ' . htmlspecialchars(Auth::user()->getName()) . ' !</div>';
    echo '</div>';
}
?>

<div class="grid">
    <div class="grid__item">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad alias aperiam assumenda atque aut commodi corporis
        deleniti deserunt dolores doloribus ea earum ex excepturi explicabo fugit id, in ipsum magnam necessitatibus
        numquam
        praesentium quas qui quisquam suscipit tenetur unde ut voluptatum? Accusamus aliquam consectetur corporis
        laboriosam
        molestiae nostrum porro repellendus!
    </div>
    <div class="grid__item">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad alias aperiam assumenda atque aut commodi corporis
        deleniti deserunt dolores doloribus ea earum ex excepturi explicabo fugit id, in ipsum magnam necessitatibus
        numquam
        praesentium quas qui quisquam suscipit tenetur unde ut voluptatum? Accusamus aliquam consectetur corporis
        laboriosam
        molestiae nostrum porro repellendus!
    </div>
    <div class="grid__item">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad alias aperiam assumenda atque aut commodi corporis
        deleniti deserunt dolores doloribus ea earum ex excepturi explicabo fugit id, in ipsum magnam necessitatibus
        numquam
        praesentium quas qui quisquam suscipit tenetur unde ut voluptatum? Accusamus aliquam consectetur corporis
        laboriosam
        molestiae nostrum porro repellendus!
    </div>
    <div class="grid__item">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad alias aperiam assumenda atque aut commodi corporis
        deleniti deserunt dolores doloribus ea earum ex excepturi explicabo fugit id, in ipsum magnam necessitatibus
        numquam
        praesentium quas qui quisquam suscipit tenetur unde ut voluptatum? Accusamus aliquam consectetur corporis
        laboriosam
        molestiae nostrum porro repellendus!
    </div>
    <div class="grid__item">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad alias aperiam assumenda atque aut commodi corporis
        deleniti deserunt dolores doloribus ea earum ex excepturi explicabo fugit id, in ipsum magnam necessitatibus
        numquam
        praesentium quas qui quisquam suscipit tenetur unde ut voluptatum? Accusamus aliquam consectetur corporis
        laboriosam
        molestiae nostrum porro repellendus!
    </div>
    <div class="grid__item">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad alias aperiam assumenda atque aut commodi corporis
        deleniti deserunt dolores doloribus ea earum ex excepturi explicabo fugit id, in ipsum magnam necessitatibus
        numquam
        praesentium quas qui quisquam suscipit tenetur unde ut voluptatum? Accusamus aliquam consectetur corporis
        laboriosam
        molestiae nostrum porro repellendus!
    </div>
    <div class="grid__item">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad alias aperiam assumenda atque aut commodi corporis
        deleniti deserunt dolores doloribus ea earum ex excepturi explicabo fugit id, in ipsum magnam necessitatibus
        numquam
        praesentium quas qui quisquam suscipit tenetur unde ut voluptatum? Accusamus aliquam consectetur corporis
        laboriosam
        molestiae nostrum porro repellendus!
    </div>
    <div class="grid__item">
        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad alias aperiam assumenda atque aut commodi corporis
        deleniti deserunt dolores doloribus ea earum ex excepturi explicabo fugit id, in ipsum magnam necessitatibus
        numquam
        praesentium quas qui quisquam suscipit tenetur unde ut voluptatum? Accusamus aliquam consectetur corporis
        laboriosam
        molestiae nostrum porro repellendus!
    </div>
</div>

<?php

use Util\Auth;

$user = Auth::user();
?>

<div class="card">
    <div class="card-title">
        Hello, <?php echo $user->getName() . ' ' . $user->getLastname(); ?>!
    </div>
    <div class="d-flex justify-center align-center">
        <a class="btn btn-primary" href="/reset-password">Reset Password</a>
    </div>
    <div class="card-footer">

    </div>
</div>
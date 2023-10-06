<?php

use Util\Auth;

$user = Auth::user();
?>

<div class="card">
    <div class="card-title">
        Hello, <?php echo $user->getName() . ' ' . $user->getLastname(); ?>!
    </div>
    <div class="form-wrapper">
        <form>
            <div class="form-group">
                <div class="form-buttons d-flex justify-center">
                    <a href="/reset-password" class="btn btn-primary">
                        <span>Reset Password</span>
                    </a>
                </div>
            </div>
        </form>
    </div>
    <div class="card-footer"></div>
</div>
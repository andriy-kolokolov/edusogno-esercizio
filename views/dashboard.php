<?php

use Dao\EventDAOImpl;
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


$eventDAO = new EventDAOImpl();
$allEvents = $eventDAO->getAllEvents();
$counter = 0;
?>

<div class="page-content">
    <h1>DASHBOARD VIEW</h1>
    <div class="grid">
        <?php
        foreach ($allEvents as $event) {
            ?>
            <div class="grid__item">
                <div class="card">
                    <div class="card-title"><?php echo $event->getEventName();?></div>
                    <!--                <div class="card__details">Event ID: -->
                    <?php //echo $event->getEventId(); ?><!--</div>-->

                    <div class="card-body">
                        <div class="card-body__sub-title">
                            Attendees:
                        </div>
                        <?php foreach ($event->getAttendees() as $attendee) { ?>
                            <?php echo '<div class="badge badge-email">' . $attendee . '</div>'; ?>
                        <?php } ?>
                    </div>

                    <div class="card-footer"><strong>Event Date:</strong> <?php echo $event->getEventDate(); ?></div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</div>

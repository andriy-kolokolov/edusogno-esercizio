<?php

use Dao\EventDAOImpl;
use Util\Auth;

$loginStatus = $_SESSION['login_status'] ?? null;
$eventCreateStatus = $_SESSION['event-create-status'] ?? null;
unset($_SESSION['login_status']);
unset($_SESSION['event-create-status']);

$eventDAO = new EventDAOImpl();
$allEvents = $eventDAO->getAllEvents();
?>

<div class="page-content">
    <?php if ($loginStatus == "success") { ?>
        <?php
        echo '<div class="alert alert-success">';
        echo '<div class="alert__message">Welcome to dashboard, ' . htmlspecialchars(Auth::user()->getName()) . ' !</div>';
        echo '</div>';
        ?>
    <?php } ?>
    <h1 class="page-title">DASHBOARD</h1>

    <div class="form-wrapper">
        <div class="form-group mb-3 d-flex justify-center">
            <a href="/event-create" class="btn btn-primary">Add event</a>
        </div>
    </div>

    <?php if ($eventCreateStatus == "success") { ?>
        <div class="form-group">
            <div class="alert alert-success">
                <div class="alert__message">
                    Event created successfully
                </div>
            </div>
        </div>
    <?php } ?>

    <div class="grid mt-3">
        <?php
        foreach ($allEvents as $event) {
            ?>
            <div class="grid__item">
                <div class="card">
                    <div class="card-title"><?php echo $event->getEventName(); ?></div>

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

<?php

use Dao\EventDAOImpl;
use Util\Auth;

$loginStatus = $_SESSION['login_status'] ?? null;
$eventCreateStatus = $_SESSION['event-create-status'] ?? null;
$updateEventStatus = $_SESSION['event-update-status'] ?? null;
$updatedEventName = $_SESSION['updated-event'] ?? null;
$deleteEventStatus = $_SESSION['event-delete-status'] ?? null;
$deletedEventName = $_SESSION['deleted-event'] ?? null;

unset($_SESSION['login_status']);
unset($_SESSION['event-update-status']);
unset($_SESSION['event-create-status']);
unset($_SESSION['event-delete-status']);

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

    <h1 class="page-title"><?php echo Auth::user()->getRole() == 'admin' ? 'DASHBOARD' : 'Events' ?></h1>

    <?php if (Auth::user()->getRole() == 'admin') { ?>
        <div class="form-wrapper">
            <div class="form-group mb-3 d-flex justify-center">
                <a href="/event-create" class="btn btn-primary">Add event</a>
            </div>
        </div>
    <?php } ?>

    <?php if ($eventCreateStatus == "success") { ?>
        <div class="form-group">
            <div class="alert alert-success">
                <div class="alert__message">
                    Event created successfully
                </div>
            </div>
        </div>
    <?php } ?>

    <?php if ($updateEventStatus == "success") { ?>
        <div class="form-group">
            <div class="alert alert-success">
                <div class="alert__message">
                    Event <strong>"<?php echo $updatedEventName ?>"</strong> updated successfully
                </div>
            </div>
        </div>
    <?php } ?>

    <?php if ($deleteEventStatus == "success") { ?>
        <div class="form-group">
            <div class="alert alert-success">
                <div class="alert__message">
                    Event <strong>"<?php echo $deletedEventName ?>"</strong> deleted successfully
                </div>
            </div>
        </div>
    <?php } else if ($deleteEventStatus == "fail") { ?>
        <div class="form-group">
            <div class="alert alert-fail">
                <div class="alert__message">
                    Failed to delete event :(
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
                    <div class="d-flex justify-around">
                        <form id="form-submit" method="POST" action="/event-update">
                            <input type="hidden" name="event_id" value="<?php echo $event->getEventId(); ?>">
                            <button id="btn-submit" type="submit" class="btn btn-sm btn-primary ">
                                <span>Update</span>
                            </button>
                        </form>
                        <form id="form-submit-1" method="POST" action="/event/delete">
                            <input type="hidden" name="event_id" value="<?php echo $event->getEventId(); ?>">
                            <button id="btn-submit-1" type="submit" class="btn btn-sm btn-danger">
                                <span>Delete</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>

    <script src="../assets/js/formSubmit.js"></script>
</div>

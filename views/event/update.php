<?php

use Dao\EventDAOImpl;

$eventUpdateStatus = $_SESSION['event-update-status'] ?? null;
unset($_SESSION['event-update-status']);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['event_id'])) {
        $eventId = intval($_POST['event_id']);
        $eventDao = new EventDAOImpl();
        $_SESSION['event'] = $eventDao->getEventById($eventId);
    }
}

// to make event available even after page reload, to fill form values
$event = $_SESSION['event'];

$eventId = $event->getEventId();
$eventName = $event->getEventName() ?? null;
$eventAttendees = implode(',', $event->getAttendees()) ?? null;
$eventDate = DateTime::createFromFormat('d M H:i', $event->getEventDate())
    ->format('Y-m-d H:i:s');
?>

<div class="page-content">
    <div class="form-wrapper">
        <form id="form-submit" class="form" action="/event/update" method="POST">
            <h2 class="form-title">Update event</h2>
            <?php if ($eventUpdateStatus == 'fail') { ?>
                <div class="form-group">
                    <div class="alert alert-fail">
                        <div class="alert__message">
                            Fail updating event :(
                        </div>
                    </div>
                </div>
            <?php } ?>

            <input type="hidden" id="event-id" name="event_id" value="<?php echo $eventId ?? null; ?>">

            <div class="form-group">
                <input class="form-input" id="event-title" type="text" name="event_name" placeholder="Event title"
                       required value="<?php echo $eventName ?? null; ?>">
                <label class="form-label" for="event-title">Event title</label>
            </div>
            <div class="form-group">
                <input class="form-input" id="event-attendees" type="text" name="event_attendees"
                       placeholder="Attendees" required value="<?php echo $eventAttendees ?? null; ?>">
                <label class="form-label" for="event-attendees">Attendees</label>
            </div>
            <div class="form-group">
                <input class="form-input" id="event-date" type="text" name="event_date" placeholder="Event date"
                       required value="<?php echo $eventDate ?? null; ?>">
                <label class="form-label" for="event-date">Event date</label>
            </div>
            <div class="form-group d-flex flex-column gap-1 txt-sm">
                <div> For attendees <strong>use comma ','</strong> if more than 1 email:</div>
                <div> Event date accept only: <strong>YYYY-mm-dd HH-mm-ss</strong></div>
            </div>
            <div class="form-group">
                <div class="form-buttons d-flex justify-center">
                    <button id="btn-submit" class="btn btn-primary" type="submit">
                        <span>Update event</span>
                    </button>
                </div>
            </div>

        </form>
    </div>

    <script src="../../assets/js/formSubmit.js"></script>
</div>



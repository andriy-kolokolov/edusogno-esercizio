<?php
$eventCreateStatus = $_SESSION['event-create-status'] ?? null;
?>

<div class="page-content">
    <div class="form-wrapper">
        <form class="form-submit" action="/event/store" method="POST">
            <h2 class="form-title">Add new event</h2>
            <?php if ($eventCreateStatus == "fail") { ?>
                <div class="form-group">
                    <div class="alert alert-fail">
                        <div class="alert__message">
                            Fail creating event :(
                        </div>
                    </div>
                </div>
            <?php } ?>
            <div class="form-group">
                <input class="form-input" id="event-title" type="text" name="event_name" placeholder="Event title"
                       required>
                <label class="form-label" for="event-title">Event title</label>
            </div>
            <div class="form-group">
                <input class="form-input" id="event-attendees" type="text" name="event_attendees"
                       placeholder="Attendees" required>
                <label class="form-label" for="event-attendees">Attendees</label>
            </div>
            <div class="form-group">
                <input class="form-input" id="event-date" type="text" name="event_date" placeholder="Event date"
                       required>
                <label class="form-label" for="event-date">Event date</label>
            </div>
            <div class="form-group d-flex flex-column gap-1 txt-sm">
                <div> <strong>As one of attendees use your mail to test email alert</strong></div>
                <div> For attendees <strong>use comma ','</strong> if more than 1 email:</div>
                <div> Event date accept only: <strong>YYYY-mm-dd HH-mm-ss</strong></div>
            </div>
            <div class="form-group">
                <div class="form-buttons d-flex justify-between">
                    <button id="btn-fill-form-test-data" class="btn btn-secondary btn-animation-pulse">
                        Fill form to test
                    </button>
                    <button class="btn btn-submit btn-primary" type="submit">
                        <span>Create new event</span>
                    </button>
                </div>
            </div>

        </form>
    </div>

    <script src="../../assets/js/formSubmit.js"></script>
    <script src="../../assets/js/fillCreateEventForm.js"></script>
</div>


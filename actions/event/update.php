<?php

use Dao\EventDAOImpl;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $eventId = $_POST['event_id'];
    $attendees = $_POST['event_attendees'];
    $eventName = $_POST['event_name'];
    $eventDate = $_POST['event_date'];

    $eventDao = new EventDAOImpl();
    if ($eventDao->update($eventId, $attendees, $eventName, $eventDate)) {
        $_SESSION['event-update-status'] = 'success';
        $_SESSION['updated-event'] = $eventName;
        unset($_SESSION['event']);
        header("Location: /dashboard");
    } else {
        $_SESSION['event-update-status'] = 'fail';
        header("Location: /event-update");
    }
    exit(); // ensure script will not be executed after redirect
}
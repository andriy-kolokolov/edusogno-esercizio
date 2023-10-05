<?php

use Dao\EventDAOImpl;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $attendees = $_POST['event_attendees'];
    $eventName = $_POST['event_name'];
    $eventDate = $_POST['event_date'];

    $eventDao = new EventDAOImpl();
    if ($eventDao->create($attendees, $eventName, $eventDate)) {
        $_SESSION['event-create-status'] = 'success';
        header("Location: /dashboard");
    } else {
        $_SESSION['event-create-status'] = 'fail';
        header("Location: /event-create");
    }
    exit(); // ensure script will not be executed after redirect
}
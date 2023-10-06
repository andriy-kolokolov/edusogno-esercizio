<?php

use Dao\EventDAOImpl;
use Util\Mailer;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $attendees = $_POST['event_attendees'];
    $eventName = $_POST['event_name'];
    $eventDate = $_POST['event_date'];

    $attendeesEmails = explode(",", $attendees);
    $_SESSION['attendeesEmails'] = $attendeesEmails;
    $eventDao = new EventDAOImpl();
    if ($eventDao->create($attendees, $eventName, $eventDate)) {
        $_SESSION['event-create-status'] = 'success';
        if(Mailer::sendAlerts($attendeesEmails, $eventName, $eventDate, 'created')) { // accept $attendeesEmails as array
            header("Location: /dashboard");
        }
    } else {
        $_SESSION['event-create-status'] = 'fail';
        header("Location: /event-create");
    }
    exit(); // ensure script will not be executed after redirect
}
<?php

use Dao\EventDAOImpl;
use Util\Mailer;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $eventId = $_POST['event_id'];

    $eventDao = new EventDAOImpl();
    $deletedEvent = $eventDao->getEventById($eventId);

    if ($eventDao->delete($eventId)) {
        $_SESSION['event-delete-status'] = 'success';
        $_SESSION['deleted-event'] = $deletedEvent->getEventName();
        if (Mailer::sendAlerts(
            $deletedEvent->getAttendees(), // accept $attendeesEmails as array
            $deletedEvent->getEventName(),
            $deletedEvent->getEventDate(),
            'deleted'
        )) {
            unset($_SESSION['event']);
            header("Location: /dashboard");
        };
    } else {
        $_SESSION['event-delete-status'] = 'fail';
    }
    header("Location: /dashboard");
    exit();
}
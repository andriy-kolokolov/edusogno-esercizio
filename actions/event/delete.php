<?php

use Dao\EventDAOImpl;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $eventId = $_POST['event_id'];

    $eventDao = new EventDAOImpl();
    $deletedEventName =
        $eventDao->getEventById($eventId)->getEventName();

    if ($eventDao->delete($eventId)) {
        $_SESSION['event-delete-status'] = 'success';
        $_SESSION['deleted-event'] = $deletedEventName;
    } else {
        $_SESSION['event-delete-status'] = 'fail';
    }
    header("Location: /dashboard");
    exit();
}
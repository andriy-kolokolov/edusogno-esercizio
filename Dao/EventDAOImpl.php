<?php

namespace Dao;

use Dao\EventDAO;
use DateTime;
use Exception;
use Model\Event;
use Util\DbUtil;

class EventDAOImpl implements EventDAO
{
    /**
     * @throws Exception
     */
    public function createGetEvent(string $attendees, string $eventName, string $eventDate): ?Event
    {
        $conn = DbUtil::getConnection();
        $sql = "INSERT INTO edusogno_db.eventi (attendees, nome_evento, data_evento) VALUES (?, ?, ?)";
        $insertStmt = $conn->prepare($sql);
        $insertStmt->bind_param("sss", $attendees, $eventName, $eventDate);

        if ($insertStmt->execute()) {
            $insertStmt->close();
            return new Event($attendees, $eventName, $eventDate);
        } else {
            $insertStmt->close();
            throw new Exception('Error occurred inserting event in database');
        }
    }

    public function update(int $eventId, string $attendees, string $eventName, string $eventDate)
    {
        // TODO: Implement update() method.
    }

    public function delete(int $eventId)
    {
        // TODO: Implement delete() method.
    }

    public function getAllEvents(): array
    {
        $connection = DbUtil::getConnection();
        $query = "SELECT * FROM edusogno_db.eventi";
        $result = $connection->query($query);

        if (!$result) {
            die("Database query failed: " . $connection->error);
        }

        $events = [];

        while ($row = $result->fetch_assoc()) {
            $eventId = $row['id'];
            $attendeesString = $row['attendees'];
            $attendees = explode(',', $attendeesString); // Split the attendees string into an array
            $eventName = $row['nome_evento'];
            $eventDate =
                DateTime::createFromFormat('Y-m-d H:i:s', $row['data_evento'])
                    ->format('d M H:i');

            $event = new Event($eventId, $attendees, $eventName, $eventDate);
            $events[] = $event;
        }
        $connection->close();
        return $events;
    }
}
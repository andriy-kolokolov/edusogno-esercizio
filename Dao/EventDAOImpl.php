<?php

namespace Dao;

use Dao\EventDAO;
use DateTime;
use Exception;
use Model\Event;
use Util\DbUtil;

class EventDAOImpl implements EventDAO
{

    public function create(string $attendees, string $eventName, string $eventDate): bool
    {
        try {
            $conn = DbUtil::getConnection();
            $sql = "INSERT INTO edusogno_db.eventi (attendees, nome_evento, data_evento) VALUES (?, ?, ?)";
            $insertStmt = $conn->prepare($sql);
            $insertStmt->bind_param("sss", $attendees, $eventName, $eventDate);

            if ($insertStmt->execute()) {
                $insertStmt->close();
                return true;
            } else {
                $insertStmt->close();
                return false;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
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
        $query = "SELECT * FROM edusogno_db.eventi ORDER BY id DESC";
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
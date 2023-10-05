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

    public function update(int $eventId, string $attendees, string $eventName, string $eventDate): bool
    {
        try {
            $conn = DbUtil::getConnection();
            $sql = "UPDATE edusogno_db.eventi SET attendees = ?, nome_evento = ?, data_evento = ? WHERE id = ?";
            $updateStmt = $conn->prepare($sql);
            $updateStmt->bind_param("sssi", $attendees, $eventName, $eventDate, $eventId);

            if ($updateStmt->execute()) {
                $updateStmt->close();
                return true;
            } else {
                $updateStmt->close();
                return false;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function delete(int $eventId): bool
    {
        try {
            $conn = DbUtil::getConnection();
            $sql = "DELETE FROM edusogno_db.eventi WHERE id = ?";
            $deleteStmt = $conn->prepare($sql);
            $deleteStmt->bind_param("i", $eventId);

            if ($deleteStmt->execute()) {
                $deleteStmt->close();
                return true;
            } else {
                $deleteStmt->close();
                return false;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
            return false;
        }
    }

    public function getEventById(int $eventId): ?Event
    {
        try {
            $connection = DbUtil::getConnection();
            $sql = "SELECT * FROM edusogno_db.eventi WHERE id = ?";
            $stmt = $connection->prepare($sql);
            $stmt->bind_param("i", $eventId);

            if ($stmt->execute()) {
                $result = $stmt->get_result();

                if ($result->num_rows === 1) {
                    $row = $result->fetch_assoc();
                    $attendeesString = $row['attendees'];
                    $attendees = explode(',', $attendeesString);
                    $eventName = $row['nome_evento'];
                    $eventDate = DateTime::createFromFormat('Y-m-d H:i:s', $row['data_evento'])
                        ->format('d M H:i');

                    $event = new Event($eventId, $attendees, $eventName, $eventDate);

                    $stmt->close();
                    return $event;
                }
            }
            $stmt->close();
            return null;
        } catch (Exception $e) {
            echo $e->getMessage();
            return null;
        }
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
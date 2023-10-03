<?php

namespace Model;

class Event
{
    private int $eventId;
    private array $attendees;
    private string $eventName;
    private string $eventDate;

    public function __construct(int $eventId, array $attendees, string $eventName, string $eventDate)
    {
        $this->eventId = $eventId;
        $this->attendees = $attendees;
        $this->eventName = $eventName;
        $this->eventDate = $eventDate;
    }

    public function getEventId(): int
    {
        return $this->eventId;
    }

    public function setEventId(int $eventId): void
    {
        $this->eventId = $eventId;
    }

    public function getAttendees(): array
    {
        return $this->attendees;
    }

    public function setAttendees(array $attendees): void
    {
        $this->attendees = $attendees;
    }

    public function getEventName(): string
    {
        return $this->eventName;
    }

    public function setEventName(string $eventName): void
    {
        $this->eventName = $eventName;
    }

    public function getEventDate(): string
    {
        return $this->eventDate;
    }

    public function setEventDate(string $eventDate): void
    {
        $this->eventDate = $eventDate;
    }


}
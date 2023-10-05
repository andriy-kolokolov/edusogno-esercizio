<?php

namespace Dao;

use Model\Event;

interface EventDAO
{
    public function create(string $attendees, string $eventName, string $eventDate): bool;

    public function update(int $eventId, string $attendees, string $eventName, string $eventDate): bool;

    public function delete(int $eventId): bool;

    public function getEventById(int $eventId): ?Event;

    public function getAllEvents(): array;
}
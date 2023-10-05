<?php

namespace Dao;

use Model\Event;

interface EventDAO
{
//    public function create(string $attendees, string $eventName, string $eventDate): ?Event;

    public function update(int $eventId, string $attendees, string $eventName, string $eventDate);

    public function delete(int $eventId);

    public function getAllEvents(): array;
}
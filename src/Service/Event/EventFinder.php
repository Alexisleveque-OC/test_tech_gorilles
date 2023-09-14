<?php

namespace App\Service\Event;

use App\Repository\EventRepository;

class EventFinder
{

    private EventRepository $eventRepository;

    public function __construct(EventRepository $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    public function findAll()
    {
        return $this->eventRepository->findAll();
    }
}
<?php

namespace App\Service\Event;

use App\Entity\Event;
use Doctrine\ORM\EntityManagerInterface;

class CreateEvent
{
    private EntityManagerInterface $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    public function create(Event $event): Event
    {
        $this->manager->persist($event);
        $this->manager->flush();

        return $event;
    }

}
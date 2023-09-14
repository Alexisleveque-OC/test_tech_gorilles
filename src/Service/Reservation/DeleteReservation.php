<?php

namespace App\Service\Reservation;

use App\Entity\Reservation;
use Doctrine\ORM\EntityManagerInterface;

class DeleteReservation
{
    private EntityManagerInterface $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager= $manager;
    }

    public function deleteReservation(Reservation $reservation)
    {
        $event = $reservation->getEvent();

        $this->manager->remove($reservation);

        $this->manager->flush();

        return $event;
    }
}
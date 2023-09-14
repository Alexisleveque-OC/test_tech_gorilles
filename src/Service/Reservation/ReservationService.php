<?php

namespace App\Service\Reservation;

use App\Entity\Reservation;
use Doctrine\ORM\EntityManagerInterface;

class ReservationService
{
    private EntityManagerInterface $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    public function SaveReservation(Reservation $reservation)
    {
        $this->manager->persist($reservation->getParticipant());

        $reservation->setParticipant($reservation->getParticipant())
            ->setEvent($reservation->getEvent())
            ->setDate($reservation->getDate())
        ;


        $this->manager->persist($reservation);
        $this->manager->flush();

        return $reservation;
    }
}
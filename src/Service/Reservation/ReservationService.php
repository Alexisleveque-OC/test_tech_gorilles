<?php

namespace App\Service\Reservation;

use App\Entity\Reservation;
use App\Repository\ReservationRepository;
use Doctrine\ORM\EntityManagerInterface;

class ReservationService
{
    private EntityManagerInterface $manager;
    private ReservationRepository $reservationRepository;

    public function __construct(EntityManagerInterface $manager, ReservationRepository $reservationRepository)
    {
        $this->manager = $manager;
        $this->reservationRepository = $reservationRepository;
    }

    public function saveReservation(Reservation $reservation)
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

    public function participantAlreadyPresent(Reservation $reservation)
    {
        $emails = [];
        $reservations = $reservation->getEvent()->getReservations();
        foreach ($reservations as $reservation ){
            $emails[] = $reservation->getParticipant()->getEmail();
        }

        if (in_array($reservation->getParticipant()->getEmail(), $emails)){
            return true;
        }
        return false;

    }
}
<?php

namespace App\DataFixtures;

use App\Entity\Event;
use App\Entity\Participant;
use App\Entity\Reservation;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $events = [];
        $participants = [];

        for ($i = 1; $i <= 10; $i++) {
            $event = new Event();
            $event->setName(sprintf('événement N°%d', $i))
                ->setSpaceAvailable(mt_rand(5, 20))
                ->setStartAt(new DateTime('+ ' . 10 * $i . ' Days'));

            $manager->persist($event);

            $events[] = $event;
        }

        for ($j = 1; $j <= 20; $j++) {
            $participant = new Participant();
            $participant->setName(sprintf('name%d', $j))
                ->setFirstName(sprintf('firstname%d', $j))
                ->setEmail(sprintf('mailUser%d@mail.com', $j))
                ->setBirthDate(new \DateTimeImmutable('- ' . mt_rand(5, 50) . ' Years'));
            $manager->persist($participant);

            $participants[] = $participant;
        }

        foreach ($events as $event) {
            /** @var Event $event */
            for ($k = 1; $k <= mt_rand(1, $event->getSpaceAvailable()); $k++) {
                $reservation = new Reservation();
                $reservation->setEvent($event)
                    ->setParticipant($participants[mt_rand(0, 19)])
                    ->setDate(new DateTime('+' . mt_rand(1, 10) . 'Days'));
                $manager->persist($reservation);
            }
        }


        $manager->flush();
    }

}

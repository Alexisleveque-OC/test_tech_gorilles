<?php

namespace App\Controller;

use App\Entity\Event;
use App\Service\Event\EventFinder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EventController extends AbstractController
{
    #[Route('/liste_des_evenement', name:'app_list_event')]
    public function listEvent(EventFinder $eventFinder)
    {
        $events = $eventFinder->findAll();

        return $this->render('event/listEvent.html.twig',[
            'events' => $events
        ]);
    }

    #[Route('/evenement/{event}', name:'app_show_event')]
    public function showEvent(EventFinder $eventFinder, Event $event)
    {

        return $this->render('event/showEvent.html.twig',[
            'event' => $event
        ]);
    }

}

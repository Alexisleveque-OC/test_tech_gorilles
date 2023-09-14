<?php

namespace App\Controller;

use App\Entity\Event;
use App\Form\CreateEventType;
use App\Service\Event\CreateEvent;
use App\Service\Event\EventFinder;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EventController extends AbstractController
{
    #[Route('/liste_des_evenement', name:'app_list_event')]
    public function listEvent(EventFinder $eventFinder): Response
    {
        $events = $eventFinder->findAll();

        return $this->render('event/listEvent.html.twig',[
            'events' => $events
        ]);
    }

    #[Route('/evenement/creation', name:'app_create_event')]
    #[Route('/evenement/update/{event}', name:'app_update_event')]
    public function createEvent(Request $request, CreateEvent $createEvent, Event $event = null): RedirectResponse|Response
    {
        $editMode = false;
        if ($event){
            $editMode = true;
        }
        $form = $this->createForm(CreateEventType::class,$event);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){

            $event = $createEvent->create($form->getData());
            $this->addFlash('success', "L'évènement {$event->getName()} a bien été crée.");

            return $this->redirectToRoute('app_list_event');
        }

        return $this->render('event/createEvent.html.twig',[
            'form' => $form,
            'editMode' => $editMode
        ]);
    }

    #[Route('/evenement/{event}', name:'app_show_event')]
    public function showEvent(Event $event): Response
    {
        return $this->render('event/showEvent.html.twig',[
            'event' => $event
        ]);
    }

}

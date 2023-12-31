<?php

namespace App\Controller;

use App\Entity\Reservation;
use App\Form\DeleteReservationConfirmationType;
use App\Form\ReservationType;
use App\Service\Reservation\DeleteReservation;
use App\Service\Reservation\ReservationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReservationController extends AbstractController
{
    #[Route('/reservation_create', name: 'app_reservation_create')]
    #[Route('/reservation/update/{reservation}', name: 'app_reservation_update')]
    public function reservation(Request $request, ReservationService $reservationService, Reservation $reservation = null): Response
    {
        $editMode = false;
        if ($reservation){
            $editMode = true;
        }
        $formReservation = $this->createForm(ReservationType::class, $reservation);

        $formReservation->handleRequest($request);

        if ($formReservation->isSubmitted() && $formReservation->isValid()) {

            if ($reservationService->participantAlreadyPresent($formReservation->getData())) {
                $formReservation->addError(new FormError("Vous êtes déjà inscrit pour cette événement."));

                return $this->render('reservation/reservation.html.twig', [
                    'formReservation' => $formReservation,
                    'editMode' => $editMode
                ]);
            }

            $reservation = $reservationService->saveReservation($formReservation->getData());

            $this->addFlash("success", "Votre réservation pour l'événement : {$reservation->getEvent()->getName()} à bien été prise en compte.");

            return $this->redirectToRoute('app_reservation');
        }

        return $this->render('reservation/reservation.html.twig', [
            'formReservation' => $formReservation,
            'editMode' => $editMode,
            'reservation' => $reservation
        ]);
    }


    #[Route('/reservation/delete/{reservation}', name:'app_delete_reservation')]
    #[Route('/reservation/{reservation}', name:'app_show_reservation')]
    public function deleteEvent(Request $request, DeleteReservation $deleteReservation, Reservation $reservation): Response
    {
        $formDeleteConf = $this->createForm(DeleteReservationConfirmationType::class);

        $formDeleteConf->handleRequest($request);

        if ($formDeleteConf->isSubmitted() && $formDeleteConf->isValid()){

            $event = $deleteReservation->deleteReservation($reservation);

            $this->addFlash('info', "La réservation a bien été supprimé !");
            return $this->render('event/showEvent.html.twig',[
                'event' => $event
            ]);
        }

        return $this->render('reservation/show.html.twig',[
            'reservation' => $reservation,
            'formDeleteconf' => $formDeleteConf
        ]);
    }

}

<?php

namespace App\Controller;

use App\Form\ReservationType;
use App\Service\Reservation\ReservationService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReservationController extends AbstractController
{
    #[Route('/', name: 'app_reservation')]
    public function reservation(Request $request, ReservationService $reservationService): Response
    {
        $formReservation = $this->createForm(ReservationType::class);

        $formReservation->handleRequest($request);

        if ($formReservation->isSubmitted() && $formReservation->isValid()){
            $reservation = $reservationService->SaveReservation($formReservation->getData());

            $this->addFlash("success", "Votre réservation pour l'événement : {$reservation->getEvent()->getName()} à bien été prise en compte.");

            return $this->redirectToRoute('app_reservation');
        }

        return $this->render('reservation/reservation.html.twig', [
            'formReservation' => $formReservation
        ]);
    }
}

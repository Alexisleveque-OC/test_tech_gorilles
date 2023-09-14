<?php

namespace App\Validator\Constraints;

use App\Entity\Event;
use App\Repository\EventRepository;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class EventFullValidator extends ConstraintValidator
{
    private EventRepository $eventRepository;

    public function __construct( EventRepository $eventRepository)
    {
        $this->eventRepository = $eventRepository;
    }

    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof EventFull) {
            throw new UnexpectedTypeException($constraint, EventFull::class);
        }

        $event = $this->eventRepository->find($value);
        $space = $event->getSpaceAvailable();
        $reservedPlaces = count($event->getReservations());

        $spaceAvailable =  $space - $reservedPlaces;

        if ($spaceAvailable != 0){
            return true;
        }
        $this->context->buildViolation($constraint->message)
        ->addViolation();
        return false;
    }
}
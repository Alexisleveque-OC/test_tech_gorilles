<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

class EventFull extends Constraint
{
    public $message = "Il n'y a plus de place pour cet événement. Veuillez choisir un autre événement";

    public function __construct(mixed $options = null, array $groups = null, mixed $payload = null)
    {
        parent::__construct($options, $groups, $payload);
    }
}
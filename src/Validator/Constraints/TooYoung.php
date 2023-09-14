<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;

class TooYoung extends Constraint
{

    public $message = "Vous devez avoir au moins 18 ans pour vous inscrire.";

    public function __construct(mixed $options = null, array $groups = null, mixed $payload = null)
    {
        parent::__construct($options, $groups, $payload);
    }
}
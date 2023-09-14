<?php

namespace App\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class TooYoungValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if (!$constraint instanceof TooYoung) {
            throw new UnexpectedTypeException($constraint, TooYoung::class);
        }
        $birthDate = $value;
        $dateMin = new \DateTime('- 18 Years');

        if ($birthDate < $dateMin){
            return true;
        }

        $this->context->buildViolation($constraint->message)
            ->addViolation();
        return false;
    }

}
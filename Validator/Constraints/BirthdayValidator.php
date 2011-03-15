<?php

namespace BeSimple\FormExtraBundle\Validator\Constraints;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

/*
* @author Francis Besset <francis.besset@gmail.com>
*/
class BirthdayValidator extends ConstraintValidator
{
    const FORMAT = 'Ymd';

    public function isValid($value, Constraint $constraint)
    {
        if (empty($value)) {
            return true;
        }

        if (!$value instanceOf \DateTime) {
            throw new UnexpectedTypeException($value, 'DateTime');
        }

        $date = new \DateTime('now', $value->getTimezone());
        if ($value->format(self::FORMAT) > $date->format(self::FORMAT)) {
            $this->setMessage($constraint->message);

            return false;
        }

        if ($constraint->min) {
            $date->sub(new \DateInterval('P'.$constraint->min.'Y'));

            if ($value->format(self::FORMAT) > $date->format(self::FORMAT)) {
                $this->setMessage($constraint->messageMin, array(
                    '{{ age }}' => $constraint->min,
                ));

                return false;
            }
        }

        if ($constraint->max) {
            $date->sub(new \DateInterval('P'.$constraint->max.'Y'));

            if ($value->format(self::FORMAT) < $date->format(self::FORMAT)) {
                $this->setMessage($constraint->messageMax, array(
                    '{{ age }}' => $constraint->max,
                ));

                return false;
            }
        }

        return true;
    }
}
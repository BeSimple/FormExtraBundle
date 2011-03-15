<?php

namespace BeSimple\FormExtraBundle\Validator\Constraints;

use Symfony\Component\Validator\Exception\UnexpectedTypeException;

class Birthday extends \Symfony\Component\Validator\Constraint
{
    public $message    = 'This value is not a valid birthday';
    public $messageMin = 'You must be {{ age }} or older';
    public $messageMax = 'You must be {{ age }} or younger';

    public $min = null;
    public $max = null;

    /**
     * {@inheritDoc}
     */
    public function targets()
    {
        return self::PROPERTY_CONSTRAINT;
    }
}
<?php

namespace BeSimple\FormExtraBundle\Validator\Constraints;

/*
 * <code>
 * @formExtraValidator:Unique(property="username")
 * </code>
 *
 * Options available:
 *
 *  * property: The column name to check. Required.
 *
 * @author Francis Besset <francis.besset@gmail.com>
 */
class Unique extends \Symfony\Component\Validator\Constraint
{
    public $message = 'The value for "{{ column_name }}" already exists';

    public $property;

    /**
     * {@inheritDoc}
     */
    public function defaultOption()
    {
        return 'property';
    }

    /**
     * {@inheritDoc}
     */
    public function requiredOptions()
    {
        return array('property');
    }

    /**
     * {@inheritDoc}
     */
    public function validatedBy()
    {
        return 'form_extra.validator.unique';
    }

    /**
     * {@inheritDoc}
     */
    public function getTargets()
    {
        return self::CLASS_CONSTRAINT;
    }
}
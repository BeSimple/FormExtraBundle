<?php

namespace BeSimple\FormExtraBundle\Validator\Constraints;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\NoResultException;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

/*
* @author Francis Besset <francis.besset@gmail.com>
*/
class UniqueValidator extends ConstraintValidator
{
    protected $em;
    protected $valueClassname;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    public function isValid($value, Constraint $constraint)
    {
        $getProperty   = 'get'.$constraint->property;
        $valueProperty = $value->$getProperty();

        if (empty($valueProperty)) {
            return true;
        }

        $this->valueClassname = get_class($value);
        $query                = $this->buildQuery($value);

        try {
            $r = $this->em
                ->getRepository($this->valueClassname)
                ->createQueryBuilder('q')
                ->select($query['select'])
                ->where('q.'.$constraint->property.' = :property'.$query['where'])
                ->setParameters(array_merge(array(
                    'property' => $valueProperty,
                ), $query['parameters']))
                ->getQuery()
                ->getSingleResult()
            ;

            $this->setMessage($constraint->message, array(
                '{{ column_name }}' => $constraint->property,
            ));

            return false;
        } catch (NoResultException $e) {
            return true;
        }
    }

    protected function buildQuery($value)
    {
        $query = array(
            'select'     => '',
            'where'      => '',
            'parameters' => array(),
        );

        $identifiers = $this->em
            ->getClassMetadata($this->valueClassname)
            ->getIdentifierColumnNames()
        ;

        foreach ($identifiers as $i => $identifier) {
            $getIdentifier   = 'get'.$identifier;
            $query['select'] = 'q.'.$identifier;

            if (null === $id = $value->$getIdentifier()) {
                $query['where']     = '';
                $query['paramters'] = array();

                break;
            }

            $query['where']               .= ' AND q.'.$identifier.' != :id'.$i;
            $query['parameters']['id'.$i]  = $id;
        }

        return $query;
    }
}
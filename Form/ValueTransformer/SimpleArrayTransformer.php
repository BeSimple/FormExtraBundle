<?php

namespace BeSimple\FormExtraBundle\Form\ValueTransformer;

use Symfony\Component\Form\Configurable;
use Symfony\Component\Form\ValueTransformer\ValueTransformerInterface;

/**
 * The options available:
 *
 *  * array: The array. Required.
 *
 * @author Francis Besset <francis.besset@gmail.com>
 */
class SimpleArrayTransformer extends Configurable implements ValueTransformerInterface
{
    protected $reverseArray;

    protected function configure()
    {
        $this->addRequiredOption('array');

        parent::configure();
    }

    /*
     * @return array The array transformed
     */
    public function getArrayTransformed()
    {
        $arrayTransform = array();

        foreach ($this->getOption('array') as $value) {
            $value = $this->transform($value);
            $arrayTransform[$value] = $value;
        }

        return $arrayTransform;
    }

    /*
     * @param  mixed
     *
     * @return mixed
     */
    public function transform($value)
    {
        if (null === $value) {
            return null;
        }

        $array = $this->getOption('array');
        if (isset($array[$value])) {
            $value = $array[$value];
        }

        return $value;
    }

    /*
     * @param  mixed
     *
     * @return mixed
     */
    public function reverseTransform($value)
    {
        if (null === $value) {
            return null;
        }

        if (null === $this->reverseArray) {
            $this->reverseArray = array_flip($this->getOption('array'));
        }

        if (isset($this->reverseArray[$value])) {
            $value = $this->reverseArray[$value];
        }

        return $value;
    }
}
<?php

namespace Checkengine\DashboardBundle\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\Form\Exception\TransformationFailedException;
use Doctrine\Common\Persistence\ObjectManager;
use Checkengine\DashboardBundle\Entity\Empresa;

class EmpresaToNumberTransformer implements DataTransformerInterface
{
    /**
     * @var ObjectManager
     */
    private $om;
    /**
     * @param ObjectManager $om
     */
    public function __construct(ObjectManager $om)
    {
        $this->om = $om;
    }
    /**
     * Transforms an object (empresa) to a string (number).
     *
     * @param  Empresa|null $empresa
     * @return string
     */
    public function transform($empresa)
    {
        if (null === $empresa) {
            return "";
        }
        return $empresa->getId();
    }
    /**
     * Transforms a string (number) to an object (empresa).
     *
     * @param  string $number
     *
     * @return Empresa|null
     *
     * @throws TransformationFailedException if object (empresa) is not found.
     */
    public function reverseTransform($number)
    {
        if (!$number) {
            return null;
        }
        $empresa = $this->om
            ->getRepository('DashboardBundle:Empresa')
            ->find($number);
        ;
        if (null === $empresa) {
            throw new TransformationFailedException(sprintf(
                'An Empresa with id "%s" does not exist!',
                $number
            ));
        }
        return $empresa;
    }
}
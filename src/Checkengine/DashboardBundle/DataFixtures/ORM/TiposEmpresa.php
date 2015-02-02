<?php

/*
 * Creado por Ricardo Alcantara <richpolis@gmail.com>
 */

namespace Checkengine\DashboardBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Checkengine\DashboardBundle\Entity\TipoEmpresa;


/**
 * Fixtures de la entidad TipoEmpresa
 */
class TiposEmpresa extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    public function getOrder()
    {
        return 20;
    }

    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        // Tipo de Empresa
        $tipos = array(
            'Taller Mecánico',
            'Lubricentros',
            'Llantas y Neumáticos',
            'Lavado',
            'Asistencia de ruta',
            'Estacionamiento',
            'Seguridad',
            'Repuestos y Accesorios',
            'Car Audio'
        );
        
        foreach($tipos as $key=>$value){
            $tipo = new TipoEmpresa();
            $tipo->setNombre($value);
            $tipo->setOrden($key+1);
            $manager->persist($tipo);
        }
        
        $manager->flush();
    }

    
}
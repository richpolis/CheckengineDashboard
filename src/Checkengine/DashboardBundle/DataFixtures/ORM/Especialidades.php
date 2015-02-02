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
use Checkengine\DashboardBundle\Entity\Especialidad;


/**
 * Fixtures de la entidad Especialidad
 */
class Especialidades extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    public function getOrder()
    {
        return 30;
    }

    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {
        
        $tallerMecanico = $manager->getRepository('DashboardBundle:TipoEmpresa')->findOneBy(array(
            'nombre'=>'Taller Mecánico'
        ));
        // Especialidad as taller mecanico.
        $tiposTallerMecanico = array(
            'Mecánica General',
            'Desabolladura y Pintura',
            'Frenos',
            'Suspensión',
            'Electricidad',
            'Alineación y balanceo'
        );
        
        foreach($tiposTallerMecanico as $key=>$value){
            $tipo = new Especialidad();
            $tipo->setTipoEmpresa($tallerMecanico);        
            $tipo->setNombre($value);
            $tipo->setOrden($key+1);
            $manager->persist($tipo);
        }
        
        $lubricentro = $manager->getRepository('DashboardBundle:TipoEmpresa')->findOneBy(array(
            'nombre'=>'Lubricentros'
        ));
        // Especialidad as taller mecanico.
        $tiposLubricentro = array(
            'Cambio de aceite',
            'Mantención',
            'Limpieza Inyectores',
            'Aditivos',
            'Revisión Niveles',
            'Accesorios'
        );
        
        foreach($tiposLubricentro as $key=>$value){
            $tipo = new Especialidad();
            $tipo->setTipoEmpresa($lubricentro);        
            $tipo->setNombre($value);
            $tipo->setOrden($key+1);
            $manager->persist($tipo);
        }
        
        $asistenciaRuta = $manager->getRepository('DashboardBundle:TipoEmpresa')->findOneBy(array(
            'nombre'=>'Asistencia en Ruta'
        ));
        // Especialidades de asistencia en ruta.
        $tiposAsistenciaRuta = array(
            'Seguro',
            'Carreteras',
            'Grua',
            'Vulcanización',
            'Peajes',
            'Urgencias'
        );
        
        foreach($tiposAsistenciaRuta as $key=>$value){
            $tipo = new Especialidad();
            $tipo->setTipoEmpresa($asistenciaRuta);        
            $tipo->setNombre($value);
            $tipo->setOrden($key+1);
            $manager->persist($tipo);
        }
        
        $manager->flush();
    }

    
}
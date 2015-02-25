<?php

namespace Checkengine\DashboardBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Checkengine\DashboardBundle\Entity\Usuario;

/**
 * Fixtures de la entidad Usuario.
 */
class Usuarios extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    public function getOrder()
    {
        return 10;
    }

    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function load(ObjectManager $manager)
    {

        // Superadmin
        $admin = new Usuario();
        
        //$admin->setUsername('admin');
        $admin->setSalt(base_convert(sha1(uniqid(mt_rand(), true)), 16, 36));
        $passwordEnClaro = 'admin';
        $encoder = $this->container->get('security.encoder_factory')->getEncoder($admin);
        $passwordCodificado = $encoder->encodePassword($passwordEnClaro, $admin->getSalt());
        $admin->setPassword($passwordCodificado);
        $admin->setNombre("Administrador");
        $admin->setApellidos("General");
        $admin->setEmail('admin@checkengine.com');
        $admin->setGrupo(Usuario::GRUPO_ADMIN);
        $manager->persist($admin);
        
        //registro de un cliente que maneja empresas. Este cliente tambien puede ser usuario de la app.
        $cliente = new Usuario();
        $cliente->setSalt(base_convert(sha1(uniqid(mt_rand(), true)), 16, 36));
        $passwordEnClaro = '12345678';
        $encoder = $this->container->get('security.encoder_factory')->getEncoder($cliente);
        $passwordCodificado = $encoder->encodePassword($passwordEnClaro, $cliente->getSalt());
        $cliente->setPassword($passwordCodificado);
        $cliente->setNombre("Richpolis");
        $cliente->setApellidos("Sistems");
        $cliente->setEmail('richpolis@gmail.com');
        $cliente->setGrupo(Usuario::GRUPO_CLIENTES);
        $manager->persist($cliente);
        
        
        // usuario de la aplicacion.
        $usuario = new Usuario();
        $usuario->setSalt(base_convert(sha1(uniqid(mt_rand(), true)), 16, 36));
        $passwordEnClaro = '12345678';
        $encoder = $this->container->get('security.encoder_factory')->getEncoder($usuario);
        $passwordCodificado = $encoder->encodePassword($passwordEnClaro, $usuario->getSalt());
        $usuario->setPassword($passwordCodificado);
        $usuario->setNombre("Ricardo");
        $usuario->setApellidos("Alcantara");
        $usuario->setEmail('richpolis@hotmail.com');
        $usuario->setGrupo(Usuario::GRUPO_USUARIOS);
        $manager->persist($usuario);
        

        $manager->flush();
    }

    
}
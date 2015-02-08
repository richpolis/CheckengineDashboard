<?php

namespace Checkengine\ApiBundle\Handler;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

use Checkengine\DashboardBundle\Entity\Usuario;
use Checkengine\ApiBundle\Form\UsuarioApiType;
use Checkengine\ApiBundle\Exception\InvalidFormException;

use Checkengine\DashboardBundle\Entity\Vehiculo;
use Checkengine\ApiBundle\Form\VehiculoApiType;

use Checkengine\DashboardBundle\Entity\Empresa;

use Checkengine\DashboardBundle\Entity\Busqueda;
use Checkengine\ApiBundle\Form\BusquedaApiType;

use Checkengine\DashboardBundle\Entity\Comentario;
use Checkengine\DashboardBundle\Form\ComentarioType;

use Checkengine\DashboardBundle\Entity\Contacto;
use Checkengine\ApiBundle\Form\ContactoApiType;

class UsuarioHandler
{
    private $om;
    private $entityClass;
    private $repository;
    private $formFactory;
    private $encoderFactory;
    
    public function __construct(ObjectManager $om, $entityClass, FormFactoryInterface $formFactory,EncoderFactoryInterface $encoderFactory)
    {
        $this->om = $om;
        $this->entityClass = $entityClass;
        $this->repository = $this->om->getRepository($this->entityClass);
        $this->formFactory = $formFactory;
        $this->encoderFactory = $encoderFactory;
    }
    
    /**
     * Get a Usuario.
     *
     * @param mixed $id
     *
     * @return Usuario
     */
    public function get($id)
    {
        return $this->repository->find($id);
    }
    
    /**
     * Get a list of Usuarios.
     *
     * @param int $limit  the limit of the result
     * @param int $offset starting from the offset
     *
     * @return array
     */
    public function all($limit = 5, $offset = 0)
    {
        return $this->repository->findBy(array(), null, $limit, $offset);
    }
    
    /**
     * Create a new Usuario.
     *
     * @param array $parameters
     *
     * @return Usuario
     */
    public function post(array $parameters)
    {
        $usuario = $this->createUsuario();
        return $this->processForm($usuario, $parameters, 'POST');
    }
    
    /**
     * Create a new Vehiculo del Usuario.
     *
     * @param array $parameters
     *
     * @return Vehiculo
     */
    public function postVehiculo(array $parameters,$idUsuario)
    {
        $method = "POST";
        $form = $this->formFactory->create(new VehiculoApiType(), new Vehiculo(), array(
            'method' => $method,
            'em' => $this->om
        ));
        
        if(isset($parameters['_method'])){
            unset($parameters['_method']);
        }
        
        $form->submit($parameters, 'PATCH' !== $method);
        
        if ($form->isValid()) {
            $vehiculo = $form->getData();
            $this->om->persist($vehiculo);
            $usuario = $this->repository->find($idUsuario);
            $usuario->AddVehiculo($vehiculo);
            $this->om->flush();
            return $vehiculo;
        }
        throw new InvalidFormException('Invalid submitted data', $form);
    }
    
    /**
     * Crear amigos del usuario.
     *
     * @param array $amigos
     *
     * @return $cont|integer
     */
    public function postAmigos(array $amigos,$idUsuario)
    {
        // recibe un arreglo de emails de los amigos del usuario
        $cont = 0;
        $usuario = $this->repository->find($idUsuario);
        
        if($usuario==null) return null;
        
        foreach($amigos as $email){
            $amigo = $this->repository->findBy(array('email'=>$eamil));
            if($amigo != null){
                $cont++;
                $usuario->AddAmigo($amigo);
            }
        }
        $this->om->flush();
        return $cont;
    }
    
    /**
     * Crear favoritos del usuario.
     *
     * @param Empresa $empresa
     *
     * @return $usuario|Usuario
     */
    public function postFavorito(Empresa $empresa,$idUsuario)
    {
        // recibe un arreglo de emails de los amigos del usuario
        $cont = 0;
        $usuario = $this->repository->find($idUsuario);
        
        if($usuario==null) return null;
        $usuario->AddFavorito($empresa);
        $this->om->flush();
        return $usuario;
    }
    
    /**
     * Crear no recibir ofertas del usuario.
     *
     * @param Empresa $empresa
     *
     * @return $usuario|Usuario
     */
    public function postNoOferta(Empresa $empresa,$idUsuario)
    {
        // recibe un arreglo de emails de los amigos del usuario
        $cont = 0;
        $usuario = $this->repository->find($idUsuario);
        
        if($usuario==null) return null;
        $usuario->AddNoOferta($empresa);
        $this->om->flush();
        return $usuario;
    }
    
    /**
     * Edit a Usuario.
     *
     * @param Usuario $usuario
     * @param array   $parameters
     *
     * @return Usuario
     */
    public function put(Usuario $usuario, array $parameters)
    {
        return $this->processForm($usuario, $parameters, 'PUT');
    }
    
    /**
     * Partially update a Usuario.
     *
     * @param Usuario $usuario
     * @param array   $parameters
     *
     * @return Usuario
     */
    public function patch(Usuario $usuario, array $parameters)
    {
        return $this->processForm($usuario, $parameters, 'PATCH');
    }
    
    /**
     * Processes the form.
     *
     * @param Usuario $usuario
     * @param array   $parameters
     * @param String  $method
     *
     * @return Usuario
     *
     * @throws \Richpoois\BackendBundle\Exception\InvalidFormException
     */
    private function processForm(Usuario $usuario, array $parameters, $method = "PUT")
    {
        $form = $this->formFactory->create(new UsuarioApiType(), $usuario, array('method' => $method));
        
        if(isset($parameters['_method'])){
            unset($parameters['_method']);
        }
        
        if(isset($parameters['id'])){
            unset($parameters['id']);
        }
        
        if($method=="PUT" || $method == "PATCH"){
            $current_pass = $usuario->getPassword();
        }
        
        $form->submit($parameters, 'PATCH' !== $method);
        
        if ($form->isValid()) {
            $user = $form->getData();
            if(null == $user->getPassword() && ($method == "PUT" || $method == "PATCH")) {
                $user->setPassword($current_pass);
            }else{
                $this->setSecurePassword($user);
            }
            
            $this->om->persist($user);
            $this->om->flush($user);
            return $user;
        }
        throw new InvalidFormException('Invalid submitted data', $form);
    }
    
    private function createUsuario()
    {
        return new $this->entityClass();
    }
    
    private function setSecurePassword(&$entity) {
        // encoder
        $encoder = $this->encoderFactory->getEncoder($entity);
        $passwordCodificado = $encoder->encodePassword(
                    $entity->getPassword(),
                    $entity->getSalt()
        );
        $entity->setPassword($passwordCodificado);
    }
    
    /**
     * Create a new Busqueda del Usuario.
     *
     * @param array $parameters
     *
     * @return Vehiculo
     */
    public function postBusqueda(array $parameters)
    {
        $method = "POST";
        $form = $this->formFactory->create(new BusquedaApiType(), new Busqueda(), array(
            'method' => $method,
            'em' => $this->om
        ));
        
        if(isset($parameters['_method'])){
            unset($parameters['_method']);
        }
        
        $form->submit($parameters, 'PATCH' !== $method);
        
        if ($form->isValid()) {
            $busqueda = $this->om->getRepository('DashboardBundle:Busqueda')->findBusquedaUsuario(
                    $parameters['busca'],$parameters['usuario']
            );
            if($busqueda == null){
                $busqueda = $form->getData();
                $this->om->persist($busqueda);
            }else{
                $busqueda->setClicks($busqueda->getClicks()+1);
            }
            $this->om->flush();
            return $busqueda;
        }
        throw new InvalidFormException('Invalid submitted data', $form);
    }
    
    /**
     * Create a new Comentario del Usuario.
     *
     * @param array $parameters
     *
     * @return Comentario
     */
    public function postComentario(array $parameters)
    {
        $method = "POST";
        $form = $this->formFactory->create(new ComentarioType(), new Comentario(), array(
            'method' => $method,
            'em' => $this->om
        ));
        
        if(isset($parameters['_method'])){
            unset($parameters['_method']);
        }
        
        $form->submit($parameters, 'PATCH' !== $method);
        
        if ($form->isValid()) {
            $comentario = $form->getData();
            $this->om->persist($comentario);
            $this->om->flush();
            return $comentario;
        }
        throw new InvalidFormException('Invalid submitted data', $form);
    }
    
    /**
     * Create a new Contacto|Ticket del Usuario con un comentario.
     *
     * @param array $parameters
     *
     * @return Contacto|null
     */
    public function postContacto(Comentario $comentario, $idUsuario)
    {
        $method = "POST";
        $usuario = $this->get($idUsuario);
        if($usuario == null) { return null; }
        $contacto = new Contacto();
        $contacto->setUsuario($usuario);
        $contacto->getIsActive(true);
        $contacto->addComentario($comentario);
        
        $form = $this->formFactory->create(new ComentarioType(), $comentario, array(
            'method' => $method,
            'em' => $this->om
        ));
        
        if(isset($parameters['_method'])){
            unset($parameters['_method']);
        }
        
        $form->submit($parameters, 'PATCH' !== $method);
        
        if ($form->isValid()) {
            $data = $form->getData();
            $this->om->persist($data);
            $this->om->flush();
            return $data;
        }
        throw new InvalidFormException('Invalid submitted data', $form);
    }
}


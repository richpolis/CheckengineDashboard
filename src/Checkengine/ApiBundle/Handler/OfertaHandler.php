<?php

namespace Checkengine\ApiBundle\Handler;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

use Checkengine\DashboardBundle\Entity\Oferta;
use Checkengine\ApiBundle\Form\OfertaApiType;
use Checkengine\ApiBundle\Exception\InvalidFormException;

use Checkengine\DashboardBundle\Entity\Comentario;
use Checkengine\ApiBundle\Form\ComentarioApiType;

class OfertaHandler
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
     * Get a Oferta.
     *
     * @param mixed $id
     *
     * @return Oferta
     */
    public function get($id)
    {
        return $this->repository->find($id);
    }
    
    /**
     * Get a list of Ofertas.
     *
     * @param string $tipo  el tipo de oferta
     * @param string $especialidad la especialidad de la oferta
     *
     * @return array
     */
    public function all($tipo = "", $especialidad = "")
    {
        return $this->repository->findTipoEspecialidadBy($tipo,$especialidad);
    }
    
    /**
     * Create a new Oferta.
     *
     * @param array $parameters
     *
     * @return Oferta
     */
    public function post(array $parameters)
    {
        $oferta = $this->createOferta();
        return $this->processForm($oferta, $parameters, 'POST');
    }
    
    /**
     * Create a new Comentario de la oferta.
     *
     * @param array $parameters
     *
     * @return Comentario
     */
    public function postComentario(array $parameters,$usuario,$idOferta)
    {
        $oferta = $this->repository->find($idOferta);
        $parameters['usuario']=$usuario;
        $comentario = new Comentario();
        $comentario->setUsuario($usuario);
        $comentario->setComentario($parameters['comentario']);
        $comentario->setCalificacion($paremeters['calificacion']);
        $this->om->persist($comentario);
        $this->om->flush();
        $oferta->addComentario($comentario);
        $this->om->flush();
        return $comentario;
    }
    
    /**
     * Edit a Oferta.
     *
     * @param Oferta $oferta
     * @param array   $parameters
     *
     * @return Oferta
     */
    public function put(Oferta $oferta, array $parameters)
    {
        return $this->processForm($oferta, $parameters, 'PUT');
    }
    
    /**
     * Partially update a Oferta.
     *
     * @param Oferta $oferta
     * @param array   $parameters
     *
     * @return Oferta
     */
    public function patch(Oferta $oferta, array $parameters)
    {
        return $this->processForm($oferta, $parameters, 'PATCH');
    }
    
    /**
     * Processes the form.
     *
     * @param Oferta $oferta
     * @param array   $parameters
     * @param String  $method
     *
     * @return Oferta
     *
     * @throws \Richpoois\BackendBundle\Exception\InvalidFormException
     */
    private function processForm(Oferta $oferta, array $parameters, $method = "PUT")
    {
        $form = $this->formFactory->create(new OfertaApiType(), $oferta, array('method' => $method));
        
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
    
    private function createOferta()
    {
        return new $this->entityClass();
    }
    
}


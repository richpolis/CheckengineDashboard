<?php

namespace Checkengine\ApiBundle\Handler;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

use Checkengine\DashboardBundle\Entity\Oferta;
use Checkengine\ApiBundle\Form\OfertaApiType;
use Checkengine\ApiBundle\Exception\InvalidFormException;

use Checkengine\DashboardBundle\Entity\Comentario;
use Checkengine\DashboardBundle\Form\ComentarioType;

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
     *
     * @return array
     */
    public function all($tipo = 1)
    {
        return $this->repository->findTipoBy(array('tipo'=>$tipo));
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
    public function postComentario(array $parameters,$idOferta)
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
            $oferta = $this->repository->find($idOferta);
            $oferta->AddComentario($comentario);
            $this->om->flush();
            return $comentario;
        }
        throw new InvalidFormException('Invalid submitted data', $form);
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


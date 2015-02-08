<?php

namespace Checkengine\ApiBundle\Handler;

use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

use Checkengine\DashboardBundle\Entity\Empresa;
use Checkengine\ApiBundle\Form\EmpresaApiType;
use Checkengine\ApiBundle\Exception\InvalidFormException;

use Checkengine\DashboardBundle\Entity\Comentario;
use Checkengine\DashboardBundle\Form\ComentarioType;

class EmpresaHandler
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
     * Get a Empresa.
     *
     * @param mixed $id
     *
     * @return Empresa
     */
    public function get($id)
    {
        return $this->repository->find($id);
    }
    
    /**
     * Get a list of Empresas.
     *
     * @param string $tipo  el tipo de empresa
     * @param string $especialidad la especialidad de la empresa
     *
     * @return array
     */
    public function all($tipo = "", $especialidad = "")
    {
        return $this->repository->findTipoEspecialidadBy($tipo,$especialidad);
    }
    
    /**
     * Create a new Empresa.
     *
     * @param array $parameters
     *
     * @return Empresa
     */
    public function post(array $parameters)
    {
        $empresa = $this->createEmpresa();
        return $this->processForm($empresa, $parameters, 'POST');
    }
    
    /**
     * Create a new Comentario de la empresa.
     *
     * @param array $parameters
     *
     * @return Comentario
     */
    public function postComentario(array $parameters,$idEmpresa)
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
            $empresa = $this->repository->find($idEmpresa);
            $empresa->AddComentario($comentario);
            $this->om->flush();
            return $comentario;
        }
        throw new InvalidFormException('Invalid submitted data', $form);
    }
    
    /**
     * Edit a Empresa.
     *
     * @param Empresa $empresa
     * @param array   $parameters
     *
     * @return Empresa
     */
    public function put(Empresa $empresa, array $parameters)
    {
        return $this->processForm($empresa, $parameters, 'PUT');
    }
    
    /**
     * Partially update a Empresa.
     *
     * @param Empresa $empresa
     * @param array   $parameters
     *
     * @return Empresa
     */
    public function patch(Empresa $empresa, array $parameters)
    {
        return $this->processForm($empresa, $parameters, 'PATCH');
    }
    
    /**
     * Processes the form.
     *
     * @param Empresa $empresa
     * @param array   $parameters
     * @param String  $method
     *
     * @return Empresa
     *
     * @throws \Richpoois\BackendBundle\Exception\InvalidFormException
     */
    private function processForm(Empresa $empresa, array $parameters, $method = "PUT")
    {
        $form = $this->formFactory->create(new EmpresaApiType(), $empresa, array('method' => $method));
        
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
    
    private function createEmpresa()
    {
        return new $this->entityClass();
    }
    
}


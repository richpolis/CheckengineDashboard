<?php

// Rest Full Api Empresas
namespace Checkengine\ApiBundle\Controller;

header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS ');
header('Allow GET, POST, PUT, DELETE, OPTIONS ');
header('Access-Control-Allow-Credentials: true');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: Content-Type, *');

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Util\Codes;
use FOS\RestBundle\Controller\Annotations;
use FOS\RestBundle\View\View;
use FOS\RestBundle\Request\ParamFetcherInterface;
use Symfony\Component\Form\FormTypeInterface;
use Nelmio\ApiDocBundle\Annotation\ApiDoc;

use Checkengine\ApiBundle\Exception\InvalidFormException;


class EmpresasApiController extends FOSRestController
{ 
    /**
     * List all empresas.
     *
     * @ApiDoc(
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     *
     * @Annotations\QueryParam(name="tipo", nullable=true, description="Tipo de empresa.")
     * @Annotations\QueryParam(name="especialidad", nullable=true, description="Especialidad de la empresa.")
     *
     * @Annotations\View(
     *  template = "DashboardBundle:Empresa:index.html.twig",
     *  templateVar = "pagination"
     * )
     *
     * @param Request               $request      the request object
     * @param ParamFetcherInterface $paramFetcher param fetcher service
     *
     * @return array
     */
    public function getEmpresasAction(Request $request, ParamFetcherInterface $paramFetcher)
    {
        $tipo = $paramFetcher->get('tipo');
        $tipo = null == $tipo ? "" : $tipo;
        $especialidad = $paramFetcher->get('especialidad');
        $especialidad = null == $especialidad ? "" : $especialidad;
        $handler = $this->container->get('apirest.empresa.handler');
        return $handler->all($tipo, $especialidad);
    }
    
    /**
     * Get single Empresa.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Gets a Empresa for a given id",
     *   output = "Checkengine\DashboardBundle\Entity\Empresa",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "Returned when the empresa is not found"
     *   }
     * )
     *
     * @Annotations\View(
     *  template = "DashboardBundle:Empresa:show.html.twig",
     *  templateVar="empresa"
     * )
     *
     * @param int|string    $id      the empresa id or slug
     *
     * @return array
     *
     * @throws NotFoundHttpException when empresa not exist
     */
    public function getEmpresaAction($id)
    {
        $empresa = $this->findOr404($id);
        return $empresa;
    }
    
    
    /**
     * Fetch a Empresa or throw an 404 Exception.
     *
     * @param mixed $id
     *
     * @return EmpresaInterface
     *
     * @throws NotFoundHttpException
     */
    protected function findOr404($id)
    {
        if (!($empresa = $this->container->get('apirest.empresa.handler')->find($id))) {
            throw new NotFoundHttpException(sprintf('The resource \'%s\' was not found.',$id));
        }
        return $empresa;
    }
    
    /**
     * Lista todos los comentarios de una empresa.
     *
     * @ApiDoc(
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     *
     * @Annotations\QueryParam(name="active", default=true, description="Visualizar galerias activas o inactivas.")
     * @Annotations\QueryParam(name="all", default=true, description="Muestra todas las imagenes inactivas o activas.")
     *
     * @Annotations\View(
     *  template = "DashboardBundle:Comentario:index.html.twig",
     *  templateVar = "entities"
     * )
     *
     * @param Request               $request      the request object
     * @param ParamFetcherInterface $paramFetcher param fetcher service
     *
     * @return array
     */
    public function getEmpresaComentariosAction($id){
        $empresa = $this->findOr404($id);
        $comentarios = $empresa->getComentarios();
        return $comentarios;
    }
    
    /**
     * Crea un comentario y lo agrega a una empresa.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Crea un comentario y lo agrega a una empresa.",
     *   input = "Checkengine\DashboardBundle\Form\ComentarioType",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     *
     * @Annotations\View(
     *  template = "DashboardBundle:Comentario:new.html.twig",
     *  statusCode = Codes::HTTP_BAD_REQUEST,
     *  templateVar = "form"
     * )
     *
     * @param Request $request the request object
     *
     * @return FormTypeInterface|View
     */
    public function postEmpresaComentarioAction(Request $request,$id)
    {
        try {
            $nuevoComentario = $this->container->get('apirest.empresa.handler')->postComentario(
                $request->request->all(),$id
            );
            $routeOptions = array(
                'id' => $nuevoComentario->getId(),
                '_format' => $request->getRequestFormat()
            );
            if($routeOptions['_format']=="html"){
                return $this->routeRedirectView('api_1_get_empresas', $routeOptions, Codes::HTTP_CREATED);
            }else{
                return $this->handleView($this->view($nuevoComentario,Codes::HTTP_CREATED));
            }
            return $this->routeRedirectView('api_1_get_empresas', $routeOptions, Codes::HTTP_CREATED);
        } catch (InvalidFormException $exception) {
            return $exception->getForm();
        }
    }
}
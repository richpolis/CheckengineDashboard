<?php

// Rest Full Api Empresas
namespace Checkengine\ApiBundle\Controller;

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
     * List all comentarios de una empresa.
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
     *  templateVar = "comentarios"
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
     * Create a comentario from the submitted data for one empresa.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Create a comentario from the submitted data for one empresa.",
     *   input = "Checkengine\DashboardBundle\Form\ComentarioType",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     * @Annotations\QueryParam(name="usuario", nullable=false, description="Id del Usuario que hace el comentario.")
     *
     * @Annotations\View(
     *  template = "DashboardBundle:Comentario:new.html.twig",
     *  statusCode = Codes::HTTP_BAD_REQUEST,
     *  templateVar = "result"
     * )
     *
     * @param Request $request the request object
     *
     * @return FormTypeInterface|View
     */
    public function postEmpresaComentarioAction(Request $request,$id)
    {
        try {
            $data = $request->request->all();
            
            $idUsuario = $paramFetcher->get('usuario');
            
            $usuario = $this->getDoctrine()->getRepository('DashboardBundle:Usuario')->find($idUsuario);
            
            $nuevoComentario = $this->container->get('apirest.empresa.handler')->postComentario(
                $request->request->all(),$usuario,$id
            );
            $routeOptions = array(
                'id' => $nuevoComentario->getId(),
                '_format' => $request->getRequestFormat()
            );
            if($routeOptions['_format']=="html"){
                return $this->routeRedirectView('get_empresa', $routeOptions, Codes::HTTP_CREATED);
            }else{
                return $this->handleView($this->view($nuevoComentario,Codes::HTTP_CREATED));
            }
            return $this->routeRedirectView('get_usuario', $routeOptions, Codes::HTTP_CREATED);
        } catch (InvalidFormException $exception) {
            return $exception->getForm();
        }
    }
}
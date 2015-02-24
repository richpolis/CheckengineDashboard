<?php

// Rest Full Api Ofertas
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

class OfertasApiController extends FOSRestController
{ 
    /**
     * List all ofertas.
     *
     * @ApiDoc(
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     *
     * @Annotations\QueryParam(name="tipo", default=1, description="Tipo de oferta, por default son el tipo de oferta 1.")
     *
     * @Annotations\View(
     *  template = "DashboardBundle:Oferta:index.html.twig",
     *  templateVar = "pagination"
     * )
     *
     * @param Request               $request      the request object
     * @param ParamFetcherInterface $paramFetcher param fetcher service
     *
     * @return array
     */
    public function getOfertasAction(Request $request, ParamFetcherInterface $paramFetcher)
    {
        $tipo = $paramFetcher->get('tipo');
        $tipo = null == $tipo ? 1 : $tipo;
        $handler = $this->container->get('apirest.oferta.handler');
        return $handler->all($tipo);
    }
    
    /**
     * Get single Oferta.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Gets a Oferta for a given id",
     *   output = "Checkengine\DashboardBundle\Entity\Oferta",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "Returned when the oferta is not found"
     *   }
     * )
     *
     * @Annotations\View(
     *  template = "DashboardBundle:Oferta:show.html.twig",
     *  templateVar="oferta"
     * )
     *
     * @param int|string    $id      the oferta id or slug
     *
     * @return array
     *
     * @throws NotFoundHttpException when oferta not exist
     */
    public function getOfertaAction($id)
    {
        $oferta = $this->findOr404($id);
        return $oferta;
    }
    
    
    /**
     * Fetch a Oferta or throw an 404 Exception.
     *
     * @param mixed $id
     *
     * @return OfertaInterface
     *
     * @throws NotFoundHttpException
     */
    protected function findOr404($id)
    {
        if (!($oferta = $this->container->get('apirest.oferta.handler')->find($id))) {
            throw new NotFoundHttpException(sprintf('The resource \'%s\' was not found.',$id));
        }
        return $oferta;
    }
    
    /**
     * List all comentarios de una oferta.
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
    public function getOfertaComentariosAction($id){
        $oferta = $this->findOr404($id);
        $comentarios = $oferta->getComentarios();
        return $comentarios;
    }
    
    /**
     * Create a comentario from the submitted data for one oferta.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Create a comentario from the submitted data for one oferta.",
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
    public function postOfertaComentarioAction(Request $request,$id)
    {
        try {
            $nuevoComentario = $this->container->get('apirest.oferta.handler')->postComentario(
                $request->request->all(),$id
            );
            $routeOptions = array(
                'id' => $nuevoComentario->getId(),
                '_format' => $request->getRequestFormat()
            );
            if($routeOptions['_format']=="html"){
                return $this->routeRedirectView('api_1_get_ofertas', $routeOptions, Codes::HTTP_CREATED);
            }else{
                return $this->handleView($this->view($nuevoComentario,Codes::HTTP_CREATED));
            }
            return $this->routeRedirectView('api_1_get_ofertas', $routeOptions, Codes::HTTP_CREATED);
        } catch (InvalidFormException $exception) {
            return $exception->getForm();
        }
    }
}
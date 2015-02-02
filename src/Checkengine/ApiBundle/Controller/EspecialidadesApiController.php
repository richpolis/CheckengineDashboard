<?php

// Rest Full Api Especialidades
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

class EspecialidadesApiController extends FOSRestController
{ 
    /**
     * List all tipos.
     *
     * @ApiDoc(
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     * @Annotations\QueryParam(name="tipo", nullable=true, description="Tipo de empresa.")
     *
     * @Annotations\View(
     *  template = "DashboardBundle:Especialidad:index.html.twig",
     *  templateVar = "entities"
     * )
     *
     * @param Request               $request      the request object
     * @param ParamFetcherInterface $paramFetcher param fetcher service
     *
     * @return array
     */
    public function getEspecialidadsAction(Request $request, ParamFetcherInterface $paramFetcher)
    {
        $tipo = $paramFetcher->get('tipo');
        $tipo = null == $tipo ? "" : $tipo;
        $em = $this->getDoctrine();
        $entities = $em->getRepository('DashboardBundle:Especialidad')->findAll();
        return $entities;
    }
    
    /**
     * Get single Tipo.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Gets a Tipo for a given id",
     *   output = "Checkengine\DashboardBundle\Entity\Tipo",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "Returned when the tipo is not found"
     *   }
     * )
     *
     * @Annotations\View(
     *  template = "DashboardBundle:Especialidad:show.html.twig",
     *  templateVar="tipo"
     * )
     *
     * @param int|string    $id      the tipo id or slug
     *
     * @return array
     *
     * @throws NotFoundHttpException when tipo not exist
     */
    public function getEspecialidadAction($id)
    {
        $especialidad = $this->findOr404($id);
        return $especialidad;
    }
    
    /**
     * Fetch a Especialidad or throw an 404 Exception.
     *
     * @param mixed $id
     *
     * @return UsuarioInterface
     *
     * @throws NotFoundHttpException
     */
    protected function getOr404($id)
    {
        if (!($especialidad = $this-getDoctrine()->getRepository('DashboardBundle:Especialidad')->get($id))) {
            throw new NotFoundHttpException(sprintf('The resource \'%s\' was not found.',$id));
        }
        return $especialidad;
    }
}
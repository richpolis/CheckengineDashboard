<?php

// Rest Full Api Servicios
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

class ServiciosApiController extends FOSRestController
{ 
    /**
     * List all servicios.
     *
     * @ApiDoc(
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     *
     * @Annotations\View(
     *  template = "DashboardBundle:Servicio:index.html.twig",
     *  templateVar = "entities"
     * )
     *
     * @param Request               $request      the request object
     *
     * @return array
     */
    public function getServiciosAction(Request $request)
    {
        $em = $this->getDoctrine();
        $entities = $em->getRepository('DashboardBundle:Servicio')->findAll();
        return $entities;
    }
    
    /**
     * Get single Servicio.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Gets a Servicio for a given id",
     *   output = "Checkengine\DashboardBundle\Entity\Servicio",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "Returned when the servicio is not found"
     *   }
     * )
     *
     * @Annotations\View(
     *  template = "DashboardBundle:Servicio:show.html.twig",
     *  templateVar="entity"
     * )
     *
     * @param int|string    $id      the servicio id
     *
     * @return array
     *
     * @throws NotFoundHttpException when servicio not exist
     */
    public function getServicioAction($id)
    {
        $servicio = $this->findOr404($id);
        return $servicio;
    }
    
    /**
     * Fetch a Servicio or throw an 404 Exception.
     *
     * @param mixed $id
     *
     * @return ServicioInterface
     *
     * @throws NotFoundHttpException
     */
    protected function getOr404($id)
    {
        if (!($servicio = $this-getDoctrine()->getRepository('DashboardBundle:Servicio')->get($id))) {
            throw new NotFoundHttpException(sprintf('The resource \'%s\' was not found.',$id));
        }
        return $servicio;
    }
}
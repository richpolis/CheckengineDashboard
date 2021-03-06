<?php

// Rest Full Api Preguntas
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

class PreguntasEmpresaApiController extends FOSRestController
{ 
    /**
     * List all Preguntas.
     *
     * @ApiDoc(
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     *
     * @Annotations\View(
     *  template = "DashboardBundle:Pregunta:index.html.twig",
     *  templateVar = "entities"
     * )
     *
     * @param Request               $request      the request object
     *
     * @return array
     */
    public function getPreguntasAction(Request $request)
    {
        $em = $this->getDoctrine();
        $entities = $em->getRepository('DashboardBundle:Pregunta')->findAll();
        return $entities;
    }
    
    /**
     * Get single Pregunta.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Gets a Pregunta for a given id",
     *   output = "Checkengine\DashboardBundle\Entity\Pregunta",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "Returned when the tipo is not found"
     *   }
     * )
     *
     * @Annotations\View(
     *  template = "DashboardBundle:Pregunta:show.html.twig",
     *  templateVar="entity"
     * )
     *
     * @param int|string    $id      the tipo id or slug
     *
     * @return array
     *
     * @throws NotFoundHttpException when tipo not exist
     */
    public function getPreguntaAction($id)
    {
        $tipo = $this->findOr404($id);
        return $tipo;
    }
    
    /**
     * Fetch a Pregunta or throw an 404 Exception.
     *
     * @param mixed $id
     *
     * @return UsuarioInterface
     *
     * @throws NotFoundHttpException
     */
    protected function getOr404($id)
    {
        if (!($tipo = $this-getDoctrine()->getRepository('DashboardBundle:Pregunta')->get($id))) {
            throw new NotFoundHttpException(sprintf('The resource \'%s\' was not found.',$id));
        }
        return $tipo;
    }
}
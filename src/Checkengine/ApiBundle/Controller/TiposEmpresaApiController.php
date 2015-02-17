<?php

// Rest Full Api Tipos
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

class TiposEmpresaApiController extends FOSRestController
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
     *
     * @Annotations\View(
     *  template = "DashboardBundle:TipoEmpresa:index.html.twig",
     *  templateVar = "entities"
     * )
     *
     * @param Request               $request      the request object
     *
     * @return array
     */
    public function getTiposAction(Request $request)
    {
        $em = $this->getDoctrine();
        $entities = $em->getRepository('DashboardBundle:TipoEmpresa')->findAll();
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
     *  template = "DashboardBundle:TipoEmpresa:show.html.twig",
     *  templateVar="entity"
     * )
     *
     * @param int|string    $id      the tipo id or slug
     *
     * @return array
     *
     * @throws NotFoundHttpException when tipo not exist
     */
    public function getTipoAction($id)
    {
        $tipo = $this->findOr404($id);
        return $tipo;
    }
    
    /**
     * Fetch a TipoEmpresa or throw an 404 Exception.
     *
     * @param mixed $id
     *
     * @return UsuarioInterface
     *
     * @throws NotFoundHttpException
     */
    protected function getOr404($id)
    {
        if (!($tipo = $this-getDoctrine()->getRepository('DashboardBundle:TipoEmpresa')->get($id))) {
            throw new NotFoundHttpException(sprintf('The resource \'%s\' was not found.',$id));
        }
        return $tipo;
    }
}
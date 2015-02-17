<?php

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
use Checkengine\ApiBundle\Form\UsuarioApiType;
use Checkengine\DashboardBundle\Entity\Usuario;

class UsuariosApiController extends FOSRestController
{
    
    
    /**
     * List all usuarios.
     *
     * @ApiDoc(
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     *
     * @Annotations\QueryParam(name="offset", requirements="\d+", nullable=true, description="Offset from which to start listing usuarios.")
     * @Annotations\QueryParam(name="limit", requirements="\d+", default="100", description="How many usuarios to return.")
     *
     * @Annotations\View(
     *  template = "DashboardBundle:Usuario:index.html.twig",
     *  templateVar = "usuarios"
     * )
     *
     * @param Request               $request      the request object
     * @param ParamFetcherInterface $paramFetcher param fetcher service
     *
     * @return array
     */
    public function getUsuariosAction(Request $request, ParamFetcherInterface $paramFetcher)
    {
        $offset = $paramFetcher->get('offset');
        $offset = null == $offset ? 0 : $offset;
        $limit = $paramFetcher->get('limit');
        $handler = $this->container->get('apirest.usuario.handler');
        return $handler->all($limit, $offset);
    }
    
    /**
     * Get single Usuario.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Gets a Usuario for a given id",
     *   output = "Checkengine\DashboardBundle\Entity\Usuario",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     404 = "Returned when the usuario is not found"
     *   }
     * )
     *
     * @Annotations\View(
     *  template = "DashboardBundle:Usuario:show.html.twig",
     *  templateVar="usuario"
     * )
     *
     * @param int     $id      the usuario id
     *
     * @return array
     *
     * @throws NotFoundHttpException when usuario not exist
     */
    public function getUsuarioAction($id)
    {
        $usuario = $this->getOr404($id);
        return $usuario;
    }
    
    /**
     * Presents the form to use to create a new usuario.
     *
     * @ApiDoc(
     *   resource = true,
     *   statusCodes = {
     *     200 = "Returned when successful"
     *   }
     * )
     *
     * @Annotations\View(
     *  template = "DashboardBundle:Usuario:new.html.twig",
     *  templateVar = "form"
     * )
     * 
     * @return FormTypeInterface
     */
    public function newUsuarioAction()
    {
        return $this->createForm(new UsuarioType(),new Usuario());
    }
    
    /**
     * Create a Usuario from the submitted data.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Creates a new usuario from the submitted data.",
     *   input = "Checkengine\DashboardBundle\Form\UsuarioType",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     *
     * @Annotations\View(
     *  template = "DashboardBundle:Usuario:new.html.twig",
     *  statusCode = Codes::HTTP_BAD_REQUEST,
     *  templateVar = "form"
     * )
     *
     * @param Request $request the request object
     *
     * @return FormTypeInterface|View
     */
    public function postUsuarioAction(Request $request)
    {
        try {
            $newUsuario = $this->container->get('apirest.usuario.handler')->post(
                $request->request->all()
            );
            $routeOptions = array(
                'id' => $newUsuario->getId(),
                '_format' => $request->getRequestFormat()
            );
            if($routeOptions['_format']=="html"){
                return $this->routeRedirectView('get_usuario', $routeOptions, Codes::HTTP_CREATED);
            }else{
                return $this->handleView($this->view($newUsuario,Codes::HTTP_CREATED));
            }
            return $this->routeRedirectView('get_usuario', $routeOptions, Codes::HTTP_CREATED);
        } catch (InvalidFormException $exception) {
            return $exception->getForm();
        }
    }
    
    /**
     * Presents the form to use to update an existing note.
     *
     * @ApiDoc(
     *   resource = true,
     *   statusCodes={
     *     200 = "Returned when successful",
     *     404 = "Returned when the note is not found"
     *   }
     * )
     *
     * @Annotations\View(
     *  template = "DashboardBundle:Usuario:edit.html.twig",
     *  templateVar = "form"
     * )
     *
     * @param Request $request the request object
     * @param int     $id      the note id
     *
     * 
     * @return FormTypeInterface
     *
     * @throws NotFoundHttpException when note not exist
     */
    public function editUsuarioAction($id)
    {
        $usuario = $this->getOr404($id);
        return $this->createForm(new UsuarioType(),$usuario);
    }
    
    /**
     * Update existing usuario from the submitted data or create a new usuario at a specific location.
     *
     * @ApiDoc(
     *   resource = true,
     *   input = "Checkengine\DashboardBundle\Form\UsuarioType",
     *   statusCodes = {
     *     201 = "Returned when the Usuario is created",
     *     204 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     *
     * @Annotations\View(
     *  template = "DashboardBundle:Usuario:edit.html.twig",
     *  templateVar = "form"
     * )
     *
     * @param Request $request the request object
     * @param int     $id      the usuario id
     *
     * 
     * @return FormTypeInterface|View
     *
     * @throws NotFoundHttpException when usuario not exist
     */
    public function putUsuarioAction(Request $request, $id)
    {
        try {
            if (!($usuario = $this->container->get('apirest.usuario.handler')->get($id))) {
                $statusCode = Codes::HTTP_CREATED;
                $usuario = $this->container->get('apirest.usuario.handler')->post(
                    $request->request->all()
                );
            } else {
                $statusCode = Codes::HTTP_NO_CONTENT;
                $usuario = $this->container->get('apirest.usuario.handler')->put(
                    $usuario,
                    $request->request->all()
                );
            }
            $routeOptions = array(
                'id' => $usuario->getId(),
                '_format' => $request->getRequestFormat()
            );
            
            if($routeOptions['_format']=="html"){
                return $this->routeRedirectView('get_usuario', $routeOptions, $statusCode);
            }else{
                return $this->handleView($this->view(null,$statusCode));
            }
            
        } catch (InvalidFormException $exception) {
            return $exception->getForm();
        }
    }
    
    /**
     * Update existing usuario from the submitted data or create a new usuario at a specific location.
     *
     * @ApiDoc(
     *   resource = true,
     *   input = "Checkengine\DashboardBundle\Form\UsuarioType",
     *   statusCodes = {
     *     204 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     *
     * @Annotations\View(
     *  template = "DashboardBundle:Usuario:edit.html.twig",
     *  templateVar = "form"
     * )
     *
     * @param Request $request the request object
     * @param int     $id      the usuario id
     * 
     *
     * @return FormTypeInterface|View
     *
     * @throws NotFoundHttpException when usuario not exist
     */
    public function patchUsuarioAction(Request $request, $id)
    {
        try {
            $usuario = $this->container->get('apirest.usuario.handler')->patch(
                $this->getOr404($id),
                $request->request->all()
            );
            $routeOptions = array(
                'id' => $usuario->getId(),
                '_format' => $request->getRequestFormat()
            );
            
            if($routeOptions['_format']=="html"){
                return $this->routeRedirectView('get_usuario', $routeOptions, Codes::HTTP_NO_CONTENT);
            }else{
                return $this->handleView($this->view(null,Codes::HTTP_NO_CONTENT));
            }
            
        } catch (InvalidFormException $exception) {
            return $exception->getForm();
        }
    }
    
    /**
     * Removes a usuario.
     *
     * @ApiDoc(
     *   resource = true,
     *   statusCodes={
     *     204="Returned when successful",
     *     404="Returned when the usuario is not found"
     *   }
     * )
     *
     * @param Request $request the request object
     * @param int     $id      the usuario id
     * 
     *
     * @return RouteRedirectView
     *
     * @throws NotFoundHttpException when usuario not exist
     */
    public function deleteUsuarioAction(Request $request, $id)
    {
        $usuario = $this->getOr404($id);
        $em = $this->getDoctrine()->getManager();
        foreach($usuario->getPublicaciones() as $publicacion){
            foreach($publicacion->getGalerias() as $galeria){
                $em->remove($galeria);
            }
            $em->remove($publicacion);
        }
        $em->remove($usuario);
        $em->flush();
        $routeOptions = array(
            '_format' => $request->getRequestFormat()
        );
        if($routeOptions['_format']=="html"){
            return $this->routeRedirectView('get_usuarios', $routeOptions, Codes::HTTP_NO_CONTENT);
        }else{
            return $this->handleView($this->view(null,Codes::HTTP_NO_CONTENT));
        }
    }
    
    /**
     * Fetch a Usuario or throw an 404 Exception.
     *
     * @param mixed $id
     *
     * @return UsuarioInterface
     *
     * @throws NotFoundHttpException
     */
    protected function getOr404($id)
    {
        if (!($usuario = $this->container->get('apirest.usuario.handler')->get($id))) {
            throw new NotFoundHttpException(sprintf('The resource \'%s\' was not found.',$id));
        }
        return $usuario;
    }
    
    /**
     * Lista todos los vehiculos de un usuario.
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
     *  template = "DashboardBundle:Vehiculo:index.html.twig",
     *  templateVar = "entities"
     * )
     *
     * @param Request               $request      the request object
     * @param ParamFetcherInterface $paramFetcher param fetcher service
     *
     * @return array
     */
    public function getUsuarioVehiculosAction($id){
        $usuario = $this->findOr404($id);
        $vehiculos = $usuario->getVehiculos();
        return $vehiculos;
    }
    
    /**
     * Crea un vehiculo y lo agrega a una usuario.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Crea un vehiculo y lo agrega a un usuario.",
     *   input = "Checkengine\ApiBundle\Form\VehiculoApiType",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     *
     * @Annotations\View(
     *  template = "DashboardBundle:Vehiculo:new.html.twig",
     *  statusCode = Codes::HTTP_BAD_REQUEST,
     *  templateVar = "form"
     * )
     *
     * @param Request $request the request object
     *
     * @return FormTypeInterface|View
     */
    public function postUsuarioVehiculoAction(Request $request,$id)
    {
        try {
            $nuevoVehiculo = $this->container->get('apirest.usuario.handler')->postVehiculo(
                $request->request->all(),$id
            );
            $routeOptions = array(
                'id' => $nuevoVehiculo->getId(),
                '_format' => $request->getRequestFormat()
            );
            if($routeOptions['_format']=="html"){
                return $this->routeRedirectView('api_1_get_usuarios', $routeOptions, Codes::HTTP_CREATED);
            }else{
                return $this->handleView($this->view($nuevoVehiculo,Codes::HTTP_CREATED));
            }
            return $this->routeRedirectView('api_1_get_usuarios', $routeOptions, Codes::HTTP_CREATED);
        } catch (InvalidFormException $exception) {
            return $exception->getForm();
        }
    }
    
    /**
     * Agrega los amigos del usuario.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Crea los amigos del usaurio basados en un arreglo de emails.",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when user is null"
     *   }
     * )
     * 
     * @Annotations\View(
     *  template = "DashboardBundle:Usuario:show.html.twig",
     *  templateVar="entity"
     * )
     *
     * @param int     $id      the usuario id
     *
     * @return array
     *
     * @throws NotFoundHttpException when usuario not exist
     */
    public function postUsuarioAmigosAction(Request $request,$id)
    {
        $contAmigos = $this->container->get('apirest.usuario.handler')->postAmigos(
            $request->request->all(),$id
        );
        $routeOptions = array(
            'id' => $id,
            '_format' => $request->getRequestFormat()
        );
        if($routeOptions['_format']=="html"){
            return $this->routeRedirectView('api_1_get_usuarios', $routeOptions, Codes::HTTP_CREATED);
        }else{
            return $this->handleView($this->view(array('amigos'=>$contAmigos),Codes::HTTP_CREATED));
        }
        return $this->routeRedirectView('api_1_get_usuarios', $routeOptions, Codes::HTTP_CREATED);
    }
    
    /**
     * Agrega favoritos del usuario.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Crea los favoritos del usuario.",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when user is null"
     *   }
     * )
     * @Annotations\QueryParam(name="empresaId", requirements="\d+", nullable=false, description="El Id de la empresa que va a ser Favorito del usuario.")
     * 
     * @Annotations\View(
     *  template = "DashboardBundle:Usuario:show.html.twig",
     *  templateVar="entity"
     * )
     *
     * @param int     $id      the usuario id
     *
     * @return $usuario | Usuario
     *
     * @throws NotFoundHttpException when usuario not exist
     */
    public function postUsuarioFavoritosAction(Request $request,$id, ParamFetcherInterface $paramFetcher)
    {
        $empresaId = $paramFetcher->get('empresaId');
        $empresa = $this->om->getRepository('DashboardBundle:Empresa')->find($empresaId);
        $usuario = $this->container->get('apirest.usuario.handler')->postFavorito(
            $empresa,$id
        );
        $routeOptions = array(
            'id' => $id,
            '_format' => $request->getRequestFormat()
        );
        if($routeOptions['_format']=="html"){
            return $this->routeRedirectView('api_1_get_usuarios', $routeOptions, Codes::HTTP_CREATED);
        }else{
            return $this->handleView($this->view($usuario,Codes::HTTP_CREATED));
        }
        return $this->routeRedirectView('api_1_get_usuarios', $routeOptions, Codes::HTTP_CREATED);
    }
    
    /**
     * Agrega No ofertas del usuario.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Crea las empresas de las que no quiere recibir ofertas el usuario.",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when user is null"
     *   }
     * )
     * @Annotations\QueryParam(name="empresaId", requirements="\d+", nullable=false, description="El Id de la empresa de la que no quiere recibir ofertas el usuario.")
     * 
     * @Annotations\View(
     *  template = "DashboardBundle:Usuario:show.html.twig",
     *  templateVar="entity"
     * )
     *
     * @param int     $id      the usuario id
     *
     * @return $usuario | Usuario
     *
     * @throws NotFoundHttpException when usuario not exist
     */
    public function postUsuarioNofertasAction(Request $request,$id, ParamFetcherInterface $paramFetcher)
    {
        $empresaId = $paramFetcher->get('empresaId');
        $empresa = $this->om->getRepository('DashboardBundle:Empresa')->find($empresaId);
        $usuario = $this->container->get('apirest.usuario.handler')->postFavoritos(
            $empresa,$id
        );
        $routeOptions = array(
            'id' => $id,
            '_format' => $request->getRequestFormat()
        );
        if($routeOptions['_format']=="html"){
            return $this->routeRedirectView('api_1_get_usuarios', $routeOptions, Codes::HTTP_CREATED);
        }else{
            return $this->handleView($this->view($usuario,Codes::HTTP_CREATED));
        }
        return $this->routeRedirectView('api_1_get_usuarios', $routeOptions, Codes::HTTP_CREATED);
    }
    
    /**
     * Crea una busqueda realizada por el usuario.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Crea una busqueda realizada por el usuario.",
     *   input = "Checkengine\ApiBundle\Form\BusquedaApiType",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     *
     * @Annotations\View(
     *  template = "DashboardBundle:Busqueda:new.html.twig",
     *  statusCode = Codes::HTTP_BAD_REQUEST,
     *  templateVar = "form"
     * )
     *
     * @param Request $request the request object
     *
     * @return FormTypeInterface|View
     */
    public function postUsuarioBusquedaAction(Request $request,$id)
    {
        try {
            $busqueda = $request->request->all();
            if(!isset($busqueda['usuario'])){ $busqueda['usuario']=$id; }
            $nuevaBusqueda = $this->container->get('apirest.usuario.handler')->postBusqueda(
                $busqueda
            );
            $routeOptions = array(
                'id' => $nuevaBusqueda->getId(),
                '_format' => $request->getRequestFormat()
            );
            if($routeOptions['_format']=="html"){
                return $this->routeRedirectView('api_1_get_usuarios', $routeOptions, Codes::HTTP_CREATED);
            }else{
                return $this->handleView($this->view($nuevaBusqueda,Codes::HTTP_CREATED));
            }
            return $this->routeRedirectView('api_1_get_usuarios', $routeOptions, Codes::HTTP_CREATED);
        } catch (InvalidFormException $exception) {
            return $exception->getForm();
        }
    }
    
    /**
     * Crea un comentario del usuario al administrador y lo agrega en una conversacion de contacto.
     *
     * @ApiDoc(
     *   resource = true,
     *   description = "Crea un comentario del usuario al administrador y lo agrega en una conversacion de contacto.",
     *   input = "Checkengine\ApiBundle\Form\ContactoApiType",
     *   statusCodes = {
     *     200 = "Returned when successful",
     *     400 = "Returned when the form has errors"
     *   }
     * )
     *
     * @Annotations\View(
     *  template = "DashboardBundle:Contacto:new.html.twig",
     *  statusCode = Codes::HTTP_BAD_REQUEST,
     *  templateVar = "form"
     * )
     *
     * @param Request $request the request object
     *
     * @return FormTypeInterface|View
     */
    public function postUsuarioContactoAction(Request $request,$id)
    {
        try {
            $busqueda = $request->request->all();
            if(!isset($busqueda['usuario'])){ $busqueda['usuario']=$id; }
            $nuevoComentario = $this->container->get('apirest.usuario.handler')->postComentario(
                $busqueda
            );
            $nuevoContacto = $this->container->get('apirest.usuario.handler')->postContacto(
                $nuevoComentario,$id
            );
            $routeOptions = array(
                'id' => $nuevoContacto->getId(),
                '_format' => $request->getRequestFormat()
            );
            if($routeOptions['_format']=="html"){
                return $this->routeRedirectView('api_1_get_usuarios', $routeOptions, Codes::HTTP_CREATED);
            }else{
                return $this->handleView($this->view($nuevoContacto,Codes::HTTP_CREATED));
            }
            return $this->routeRedirectView('api_1_get_usuarios', $routeOptions, Codes::HTTP_CREATED);
        } catch (InvalidFormException $exception) {
            return $exception->getForm();
        }
    }
}
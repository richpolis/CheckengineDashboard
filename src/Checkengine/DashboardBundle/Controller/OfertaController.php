<?php

namespace Checkengine\DashboardBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Checkengine\DashboardBundle\Entity\Oferta;
use Checkengine\DashboardBundle\Form\OfertaType;

/**
 * Oferta controller.
 *
 * @Route("/ofertas")
 */
class OfertaController extends Controller
{

    /**
     * Lists all Oferta entities.
     *
     * @Route("/", name="ofertas")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        if ($this->get('security.context')->isGranted('ROLE_CLIENTE')) {
            $buscar = $request->get('buscar','');
            if(strlen($buscar)>0){
                $options = array('filterParam'=>'buscar','filterValue'=>$buscar);
            }else{
                $options = array();
            }
            $query = $em->getRepository('DashboardBundle:Oferta')->queryFindOfertas($buscar);
            $paginator = $this->get('knp_paginator');
            $pagination = $paginator->paginate(
                    $query, $this->get('request')->query->get('page', 1),10,$options
            );
            
            return  compact('pagination');
        } 
        return $this->redirect('login');
    }
    /**
     * Creates a new Oferta entity.
     *
     * @Route("/", name="ofertas_create")
     * @Method("POST")
     * @Template("DashboardBundle:Oferta:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Oferta();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('ofertas_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Oferta entity.
     *
     * @param Oferta $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Oferta $entity)
    {
        $form = $this->createForm(new OfertaType(), $entity, array(
            'action' => $this->generateUrl('ofertas_create'),
            'method' => 'POST',
        ));

        //$form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Oferta entity.
     *
     * @Route("/new", name="ofertas_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Oferta();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Oferta entity.
     *
     * @Route("/{id}", name="ofertas_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DashboardBundle:Oferta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Oferta entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Oferta entity.
     *
     * @Route("/{id}/edit", name="ofertas_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DashboardBundle:Oferta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Oferta entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Oferta entity.
    *
    * @param Oferta $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Oferta $entity)
    {
        $form = $this->createForm(new OfertaType(), $entity, array(
            'action' => $this->generateUrl('ofertas_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        //$form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Oferta entity.
     *
     * @Route("/{id}", name="ofertas_update")
     * @Method("PUT")
     * @Template("DashboardBundle:Oferta:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DashboardBundle:Oferta')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Oferta entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('ofertas_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Oferta entity.
     *
     * @Route("/{id}", name="ofertas_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('DashboardBundle:Oferta')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Oferta entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('ofertas'));
    }

    /**
     * Creates a form to delete a Oferta entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('ofertas_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete','attr'=>array('class'=>'btn btn-danger')))
            ->getForm()
        ;
    }
    
    /**
     * Exporta la lista completa de ofertas.
     *
     * @Route("/exportar", name="ofertas_export")
     * @Method("GET")
     */
    public function exportarAction() {
        $ofertas = $this->getDoctrine()
                ->getRepository('DashboardBundle:Oferta')
                ->findOfertas();
        $response = $this->render(
                'DashboardBundle:Oferta:list.xls.twig', array('ofertas' => $ofertas)
        );
        $response->headers->set('Content-Type', 'text/vnd.ms-excel; charset=utf-8');
        $response->headers->set('Content-Disposition', 'attachment; filename="export-ofertas.xls"');
        return $response;
    }
    
    /**
     * Delete a Comentario from one oferta, response to json.
     *
     * @Route("/{id}/comentario/{idc}", name="ofertas_comentario_delete")
     * @Method("DELETE")
     */
    public function deleteComentarioAction(Request $request, $id, $idc) 
    {
        $em = $this->getDoctrine()->getManager();
        $oferta = $em->getRepository('DashboardBundle:Oferta')->find($id);

        if (!$oferta) {
            return new JsonResponse(array('status'=>false,'message'=>'Id de oferta no encontrado'));
        }
        
        $comentario = $em->getRepository('DashboardBundle:Comentario')->find($idc);
        
        if (!$comentario) {
            return new JsonResponse(array('status'=>false,'message'=>'Id de comentario no encontrado'));
        }
        $oferta->removeComentario($comentario);
        $em->remove($comentario);
        $em->flush();

        return new JsonResponse(array('status'=>true,'message'=>'Id de comentario eliminado'));
    }
}

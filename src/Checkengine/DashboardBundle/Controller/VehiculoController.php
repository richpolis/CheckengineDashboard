<?php

namespace Checkengine\DashboardBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Checkengine\DashboardBundle\Entity\Vehiculo;
use Checkengine\DashboardBundle\Form\VehiculoType;

/**
 * Vehiculo controller.
 *
 * @Route("/vehiculos")
 */
class VehiculoController extends Controller
{

    /**
     * Lists all Vehiculo entities.
     *
     * @Route("/", name="vehiculos")
     * @Method("GET")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        if ($this->get('security.context')->isGranted('ROLE_ADMIN')) {
            $buscar = $request->get('buscar','');
            if(strlen($buscar)>0){
                $options = array('filterParam'=>'buscar','filterValue'=>$buscar);
            }else{
                $options = array();
            }
            $query = $em->getRepository('DashboardBundle:Vehiculo')->queryFindVehiculos($buscar);
            $paginator = $this->get('knp_paginator');
            $pagination = $paginator->paginate(
                    $query, $this->get('request')->query->get('page', 1),10,$options
            );
            
            return  compact('pagination');
        } elseif ($this->get('security.context')->isGranted('ROLE_USUARIO')) {
            $usuario = $this->get('security.context')->getToken()->getUser();
            return array($usuario);
        }
        return $this->redirect('login');
    }
    /**
     * Creates a new Vehiculo entity.
     *
     * @Route("/", name="vehiculos_create")
     * @Method("POST")
     * @Template("DashboardBundle:Vehiculo:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Vehiculo();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('vehiculos_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Vehiculo entity.
     *
     * @param Vehiculo $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Vehiculo $entity)
    {
        $form = $this->createForm(new VehiculoType(), $entity, array(
            'action' => $this->generateUrl('vehiculos_create'),
            'method' => 'POST',
        ));

        //$form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Vehiculo entity.
     *
     * @Route("/new", name="vehiculos_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Vehiculo();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Vehiculo entity.
     *
     * @Route("/{id}", name="vehiculos_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DashboardBundle:Vehiculo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Vehiculo entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Vehiculo entity.
     *
     * @Route("/{id}/edit", name="vehiculos_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DashboardBundle:Vehiculo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Vehiculo entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'form'        => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a Vehiculo entity.
    *
    * @param Vehiculo $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Vehiculo $entity)
    {
        $form = $this->createForm(new VehiculoType(), $entity, array(
            'action' => $this->generateUrl('vehiculos_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        //$form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Vehiculo entity.
     *
     * @Route("/{id}", name="vehiculos_update")
     * @Method("PUT")
     * @Template("DashboardBundle:Vehiculo:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DashboardBundle:Vehiculo')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Vehiculo entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('vehiculos_edit', array('id' => $id)));
        }

        return array(
            'entity'        => $entity,
            'form'          => $editForm->createView(),
            'delete_form'   => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Vehiculo entity.
     *
     * @Route("/{id}", name="vehiculos_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('DashboardBundle:Vehiculo')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Vehiculo entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('vehiculos'));
    }

    /**
     * Creates a form to delete a Vehiculo entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('vehiculos_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete','attr'=>array('class'=>'btn btn-danger')))
            ->getForm()
        ;
    }
    
    /**
     * Exporta la lista completa de vehiculos.
     *
     * @Route("/exportar", name="vehiculos_export")
     * @Method("GET")
     */
    public function exportarAction() {
        $vehiculos = $this->getDoctrine()
                ->getRepository('DashboardBundle:Vehiculo')
                ->findVehiculos();
        $response = $this->render(
                'DashboardBundle:Vehiculo:list.xls.twig', array('vehiculos' => $vehiculos)
        );
        $response->headers->set('Content-Type', 'text/vnd.ms-excel; charset=utf-8');
        $response->headers->set('Content-Disposition', 'attachment; filename="export-vehiculos.xls"');
        return $response;
    }
}

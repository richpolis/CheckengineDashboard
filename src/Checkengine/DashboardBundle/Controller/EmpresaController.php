<?php

namespace Checkengine\DashboardBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Checkengine\DashboardBundle\Entity\Empresa;
use Checkengine\DashboardBundle\Form\EmpresaType;

/**
 * Empresa controller.
 *
 * @Route("/empresas")
 */
class EmpresaController extends Controller
{

    /**
     * Lists all Empresa entities.
     *
     * @Route("/", name="empresas")
     * @Method("GET")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        if ($this->get('security.context')->isGranted('ROLE_CLIENTE')) {
            $buscar = $request->get('buscar','');
            if(strlen($buscar)>0){
                $options = array('filterParam'=>'buscar','filterValue'=>$buscar);
            }else{
                $options = array();
            }
            $query = $em->getRepository('DashboardBundle:Empresa')->queryFindEmpresas($buscar);
            $paginator = $this->get('knp_paginator');
            $pagination = $paginator->paginate(
                    $query, $this->get('request')->query->get('page', 1),10,$options
            );
            
            return  compact('pagination');
        } 
        return $this->redirect('login');
    }
    /**
     * Creates a new Empresa entity.
     *
     * @Route("/", name="empresas_create")
     * @Method("POST")
     * @Template("DashboardBundle:Empresa:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Empresa();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('empresas_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Empresa entity.
     *
     * @param Empresa $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Empresa $entity)
    {
        $form = $this->createForm(new EmpresaType(), $entity, array(
            'action' => $this->generateUrl('empresas_create'),
            'method' => 'POST',
        ));

        //$form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Empresa entity.
     *
     * @Route("/new", name="empresas_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Empresa();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Empresa entity.
     *
     * @Route("/{id}", name="empresas_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DashboardBundle:Empresa')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Empresa entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Empresa entity.
     *
     * @Route("/{id}/edit", name="empresas_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DashboardBundle:Empresa')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Empresa entity.');
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
    * Creates a form to edit a Empresa entity.
    *
    * @param Empresa $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Empresa $entity)
    {
        $form = $this->createForm(new EmpresaType(), $entity, array(
            'action' => $this->generateUrl('empresas_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        //$form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Empresa entity.
     *
     * @Route("/{id}", name="empresas_update")
     * @Method("PUT")
     * @Template("DashboardBundle:Empresa:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DashboardBundle:Empresa')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Empresa entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('empresas_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'form'        => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Empresa entity.
     *
     * @Route("/{id}", name="empresas_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('DashboardBundle:Empresa')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Empresa entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('empresas'));
    }

    /**
     * Creates a form to delete a Empresa entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('empresas_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete','attr'=>array('class'=>'btn btn-danger')))
            ->getForm()
        ;
    }
    
    /**
     * Exporta la lista completa de empresas.
     *
     * @Route("/exportar", name="empresas_export")
     * @Method("GET")
     */
    public function exportarAction() {
        $empresas = $this->getDoctrine()
                ->getRepository('DashboardBundle:Empresa')
                ->findEmpresas();
        $response = $this->render(
                'DashboardBundle:Empresa:list.xls.twig', array('empresas' => $empresas)
        );
        $response->headers->set('Content-Type', 'text/vnd.ms-excel; charset=utf-8');
        $response->headers->set('Content-Disposition', 'attachment; filename="export-empresas.xls"');
        return $response;
    }
}

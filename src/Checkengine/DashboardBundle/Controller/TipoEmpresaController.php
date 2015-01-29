<?php

namespace Checkengine\DashboardBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Checkengine\DashboardBundle\Entity\TipoEmpresa;
use Checkengine\DashboardBundle\Form\TipoEmpresaType;

/**
 * TipoEmpresa controller.
 *
 * @Route("/tiposempresa")
 */
class TipoEmpresaController extends Controller
{

    /**
     * Lists all TipoEmpresa entities.
     *
     * @Route("/", name="tiposempresa")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('DashboardBundle:TipoEmpresa')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new TipoEmpresa entity.
     *
     * @Route("/", name="tiposempresa_create")
     * @Method("POST")
     * @Template("DashboardBundle:TipoEmpresa:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new TipoEmpresa();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('tiposempresa_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a TipoEmpresa entity.
     *
     * @param TipoEmpresa $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(TipoEmpresa $entity)
    {
        $form = $this->createForm(new TipoEmpresaType(), $entity, array(
            'action' => $this->generateUrl('tiposempresa_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new TipoEmpresa entity.
     *
     * @Route("/new", name="tiposempresa_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new TipoEmpresa();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a TipoEmpresa entity.
     *
     * @Route("/{id}", name="tiposempresa_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DashboardBundle:TipoEmpresa')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TipoEmpresa entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing TipoEmpresa entity.
     *
     * @Route("/{id}/edit", name="tiposempresa_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DashboardBundle:TipoEmpresa')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TipoEmpresa entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
    * Creates a form to edit a TipoEmpresa entity.
    *
    * @param TipoEmpresa $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(TipoEmpresa $entity)
    {
        $form = $this->createForm(new TipoEmpresaType(), $entity, array(
            'action' => $this->generateUrl('tiposempresa_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing TipoEmpresa entity.
     *
     * @Route("/{id}", name="tiposempresa_update")
     * @Method("PUT")
     * @Template("DashboardBundle:TipoEmpresa:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DashboardBundle:TipoEmpresa')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find TipoEmpresa entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('tiposempresa_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a TipoEmpresa entity.
     *
     * @Route("/{id}", name="tiposempresa_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('DashboardBundle:TipoEmpresa')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find TipoEmpresa entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('tiposempresa'));
    }

    /**
     * Creates a form to delete a TipoEmpresa entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('tiposempresa_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete'))
            ->getForm()
        ;
    }
}

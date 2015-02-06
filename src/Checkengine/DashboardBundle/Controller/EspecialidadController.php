<?php

namespace Checkengine\DashboardBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Checkengine\DashboardBundle\Entity\Especialidad;
use Checkengine\DashboardBundle\Form\EspecialidadType;

/**
 * Especialidad controller.
 *
 * @Route("/especialidades")
 */
class EspecialidadController extends Controller
{

    /**
     * Lists all Especialidad entities.
     *
     * @Route("/", name="especialidades")
     * @Method("GET")
     * @Template()
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('DashboardBundle:Especialidad')->findAll();

        return array(
            'entities' => $entities,
        );
    }
    /**
     * Creates a new Especialidad entity.
     *
     * @Route("/", name="especialidades_create")
     * @Method("POST")
     * @Template("DashboardBundle:Especialidad:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Especialidad();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('especialidades_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Especialidad entity.
     *
     * @param Especialidad $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Especialidad $entity)
    {
        $form = $this->createForm(new EspecialidadType(), $entity, array(
            'action' => $this->generateUrl('especialidades_create'),
            'method' => 'POST',
        ));

        //$form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Especialidad entity.
     *
     * @Route("/new", name="especialidades_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Especialidad();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Especialidad entity.
     *
     * @Route("/{id}", name="especialidades_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DashboardBundle:Especialidad')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Especialidad entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Especialidad entity.
     *
     * @Route("/{id}/edit", name="especialidades_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DashboardBundle:Especialidad')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Especialidad entity.');
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
    * Creates a form to edit a Especialidad entity.
    *
    * @param Especialidad $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Especialidad $entity)
    {
        $form = $this->createForm(new EspecialidadType(), $entity, array(
            'action' => $this->generateUrl('especialidades_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        //$form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Especialidad entity.
     *
     * @Route("/{id}", name="especialidades_update")
     * @Method("PUT")
     * @Template("DashboardBundle:Especialidad:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DashboardBundle:Especialidad')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Especialidad entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('especialidades_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Especialidad entity.
     *
     * @Route("/{id}", name="especialidades_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('DashboardBundle:Especialidad')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Especialidad entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('especialidades'));
    }

    /**
     * Creates a form to delete a Especialidad entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('especialidades_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete','attr'=>array('class'=>'btn btn-danger')))
            ->getForm()
        ;
    }
}

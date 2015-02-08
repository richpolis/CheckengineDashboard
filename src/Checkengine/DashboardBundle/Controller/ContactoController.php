<?php

namespace Checkengine\DashboardBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Checkengine\DashboardBundle\Entity\Contacto;
use Checkengine\DashboardBundle\Form\ContactoType;
use Symfony\Component\HttpFoundation\JsonResponse;

/**
 * Contacto controller.
 *
 * @Route("/contactos")
 */
class ContactoController extends Controller
{

    /**
     * Lists all Contacto entities.
     *
     * @Route("/", name="contactos")
     * @Method("GET")
     * @Template()
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        if ($this->get('security.context')->isGranted('ROLE_ADMIN')) {
            return $this->indexAdmin($request);
        }elseif($this->get('security.context')->isGranted('ROLE_CLIENTE')) {
            return $this->indexCliente($request);
        } 
        return $this->redirect('login');
    }
    
    private function indexAdmin(Request $request){
        $buscar = $request->get('buscar', '');
        if (strlen($buscar) > 0) {
            $options = array('filterParam' => 'buscar', 'filterValue' => $buscar);
        } else {
            $options = array();
        }
        $query = $em->getRepository('DashboardBundle:Contacto')->queryFindContactosAdmin($buscar);
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $query, $this->get('request')->query->get('page', 1), 10, $options
        );

        return compact('pagination');
    }
    
    private function indexCliente(Request $request){
        $buscar = $request->get('buscar', '');
        if (strlen($buscar) > 0) {
            $options = array('filterParam' => 'buscar', 'filterValue' => $buscar);
        } else {
            $options = array();
        }
        $query = $em->getRepository('DashboardBundle:Contacto')->queryFindContactosCliente($this->getUser());
        $paginator = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
                $query, $this->get('request')->query->get('page', 1), 10, $options
        );

        return compact('pagination');
    }
    
    /**
     * Creates a new Contacto entity.
     *
     * @Route("/", name="contactos_create")
     * @Method("POST")
     * @Template("DashboardBundle:Contacto:new.html.twig")
     */
    public function createAction(Request $request)
    {
        $entity = new Contacto();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('contactos_show', array('id' => $entity->getId())));
        }

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Creates a form to create a Contacto entity.
     *
     * @param Contacto $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Contacto $entity)
    {
        $form = $this->createForm(new ContactoType(), $entity, array(
            'action' => $this->generateUrl('contactos_create'),
            'method' => 'POST',
        ));

        //$form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Contacto entity.
     *
     * @Route("/new", name="contactos_new")
     * @Method("GET")
     * @Template()
     */
    public function newAction()
    {
        $entity = new Contacto();
        $form   = $this->createCreateForm($entity);

        return array(
            'entity' => $entity,
            'form'   => $form->createView(),
        );
    }

    /**
     * Finds and displays a Contacto entity.
     *
     * @Route("/{id}", name="contactos_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DashboardBundle:Contacto')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Contacto entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        );
    }

    /**
     * Displays a form to edit an existing Contacto entity.
     *
     * @Route("/{id}/edit", name="contactos_edit")
     * @Method("GET")
     * @Template()
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DashboardBundle:Contacto')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Contacto entity.');
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
    * Creates a form to edit a Contacto entity.
    *
    * @param Contacto $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Contacto $entity)
    {
        $form = $this->createForm(new ContactoType(), $entity, array(
            'action' => $this->generateUrl('contactos_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        //$form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Contacto entity.
     *
     * @Route("/{id}", name="contactos_update")
     * @Method("PUT")
     * @Template("DashboardBundle:Contacto:edit.html.twig")
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('DashboardBundle:Contacto')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Contacto entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('contactos_edit', array('id' => $id)));
        }

        return array(
            'entity'      => $entity,
            'form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        );
    }
    /**
     * Deletes a Contacto entity.
     *
     * @Route("/{id}", name="contactos_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('DashboardBundle:Contacto')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Contacto entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('contactos'));
    }

    /**
     * Creates a form to delete a Contacto entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('contactos_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Delete','attr'=>array('class'=>'btn btn-danger')))
            ->getForm()
        ;
    }
    
    /**
     * Deletes a Comentario from one contacto, response to json.
     *
     * @Route("/{id}/comentario/{idc}", name="contactos_comentario_delete")
     * @Method("DELETE")
     */
    public function deleteComentarioAction(Request $request, $id, $idc) 
    {
        $em = $this->getDoctrine()->getManager();
        $contacto = $em->getRepository('DashboardBundle:Contacto')->find($id);

        if (!$contacto) {
            return new JsonResponse(array('status'=>false,'message'=>'Id de contacto no encontrado'));
        }
        
        $comentario = $em->getRepository('DashboardBundle:Comentario')->find($idc);
        
        if (!$comentario) {
            return new JsonResponse(array('status'=>false,'message'=>'Id de comentario no encontrado'));
        }
        $contacto->removeComentario($comentario);
        $em->remove($comentario);
        $em->flush();

        return new JsonResponse(array('status'=>true,'message'=>'Id de comentario eliminado'));
    }

}

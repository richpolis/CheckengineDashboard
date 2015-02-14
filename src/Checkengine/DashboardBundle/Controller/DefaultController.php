<?php

namespace Checkengine\DashboardBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use Checkengine\DashboardBundle\Entity\Enquiry;
use Checkengine\DashboardBundle\Form\EnquiryType;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }
    
    /**
     * @Route("/contacto", name="frontend_contacto")
     * @Method({"GET", "POST"})
     * @Template("DashboardBundle:Default:contacto.html.twig")
     */
    public function contactoAction() {
        $contacto = new Enquiry();
        $form = $this->createForm(new EnquiryType(), $contacto,array(
            'method'=>'POST',
            'action'=>$this->generateUrl('frontend_contacto'),
        ));
        $request = $this->getRequest();
        
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $datos=$form->getData();
                $message = \Swift_Message::newInstance()
                        ->setSubject('Enquiry desde pagina')
                        ->setFrom($datos->getEmail())
                        ->setTo($this->container->getParameter('richpolis.emails.to_email'))
                        ->setBody($this->renderView('FrontendBundle:Default:contactoEmail.html.twig', array('datos' => $datos)), 'text/html');
                $this->get('mailer')->send($message);
                $status     =   'enviado';
                $mensaje    =   "Se ha enviado el mensaje";
                $contacto   =   new Enquiry();
                $form       =   $this->createForm(new EnquiryType(), $contacto);
            }else{
                $status     =   'error';
                $mensaje    =   "El mensaje no se ha podido enviar";
            }
        }else{
            $status     =   '';
            $mensaje    =   "";
        }
        
        if($request->isXmlHttpRequest()){
            $datos = array(
              'form'    =>  $this->renderView('FrontendBundle:Default:formContacto.html.twig', 
                    array('form'=>$form->createView())
               ),
              'status'  =>  $status,
              'message' =>  $mensaje,  
            );
            return new \Symfony\Component\HttpFoundation\JsonResponse($datos);
        }
        
        return array(
              'form'    =>  $form->createView(),
              'status'  =>  $status,
              'message' =>  $mensaje,
        );
    }

}

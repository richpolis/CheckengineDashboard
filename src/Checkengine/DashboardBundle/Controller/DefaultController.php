<?php

namespace Checkengine\DashboardBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use Checkengine\DashboardBundle\Entity\Enquiry;
use Checkengine\DashboardBundle\Form\EnquiryType;

use Checkengine\DashboardBundle\Entity\Usuario;

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
    public function contactoAction(Request $request) {
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
                        ->setBody($this->renderView('DashboardBundle:Default:contactoEmail.html.twig', array('datos' => $datos)), 'text/html');
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
              'form'    =>  $this->renderView('DashboardBundle:Default:formContacto.html.twig', 
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
    
    /**
     * @Route("/recuperar",name="recuperar")
     * @Template()
     * @Method({"GET","POST"})
     */
    public function recuperarAction(Request $request)
    {   
        $sPassword = "";
        $sUsuario = "";
        $msg = "";
        if($request->isMethod('POST')){
            $email = $request->get('email');
            $usuario = $this->getDoctrine()->getRepository('DashboardBundle:Usuario')
                            ->findOneBy(array('email'=>$email));
            if(!$usuario){
                $status = array('success'=>false, 'message'=>"El email no esta registrado");
            }else{
                $sPassword = substr(md5(time()), 0, 7);
                $sUsuario = $usuario->getUsername();
                $encoder = $this->get('security.encoder_factory')
                            ->getEncoder($usuario);
                $passwordCodificado = $encoder->encodePassword(
                            $sPassword, $usuario->getSalt()
                );
                $usuario->setPassword($passwordCodificado);
                $this->getDoctrine()->getManager()->flush();
                
                $status = array('success'=>true, 'message'=>"Se ha enviado un correo a su bandeja de entrada");
                
                $this->enviarRecuperar($sUsuario, $sPassword, $usuario);
            }
            return new \Symfony\Component\HttpFoundation\JsonResponse($status);
            
        }

        return array();
    }

    private function enviarRecuperar($sUsuario, $sPassword, Usuario $usuario, $isNew = false) {
        $asunto = 'Se ha reestablecido su contraseña';
        $message = \Swift_Message::newInstance()
                ->setSubject($asunto)
                ->setFrom($this->container->getParameter('richpolis.emails.to_email'))
                ->setTo($usuario->getEmail())
                ->setBody(
                        $this->renderView('DashboardBundle:Default:enviarRegistro.html.twig', 
                                compact('usuario','sUsuario','sPassword','isNew','asunto')), 
                                'text/html'
                        );
        $this->get('mailer')->send($message);
    }
    
    /**
     * @Route("/terminos/condiciones", name="terminos")
     * @Template()
     */
    public function terminosAction()
    {
        return array();
    }

}

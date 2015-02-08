<?php

namespace Checkengine\DashboardBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EnquiryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name','text',array('label'=>'Nombre'))
            ->add('email','email')
            ->add('subject','text',array('label'=>'Asunto'))
            ->add('telefono','text',array('label'=>'Telefono'))    
            ->add('body','textarea',array('label'=>'Mensaje'))
        ;
    }
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Richpolis\FrontendBundle\Entity\Enquiry'
        ));
    }
    public function getName()
    {
        return 'contacto';
    }
}
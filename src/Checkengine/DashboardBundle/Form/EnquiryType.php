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
            ->add('name','text',array('label'=>'Nombre','required'=>true))
            ->add('email','email',array('required'=>true))
            ->add('subject','text',array('label'=>'Asunto','required'=>true))
            ->add('telefono','text',array('label'=>'Telefono'))    
            ->add('body','textarea',array('label'=>'Mensaje'))
        ;
    }
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Checkengine\DashboardBundle\Entity\Enquiry'
        ));
    }
    public function getName()
    {
        return 'contacto';
    }
}
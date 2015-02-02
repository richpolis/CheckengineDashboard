<?php

namespace Checkengine\ApiBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EmpresaApiType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre','text',array('required'=>true))
            ->add('sucursal','text',array('required'=>true))
            ->add('direccion',null,array('required'=>true))    
            ->add('rubro',null,array('required'=>true))
            ->add('rut','text',array('required'=>false))
            ->add('region','text',array('required'=>false))
            ->add('comuna','text',array('required'=>false))
            ->add('horarios','text',array('required'=>false))
            ->add('file','file',array('required'=>false,'label'=>'Logo'))
            ->add('imagen','hidden')
            ->add('ubicacionLongitud','text',array('required'=>false))
            ->add('ubicacionLatitud','text',array('required'=>false))
            ->add('isActive')
            ->add('usuario')
            ->add('tipos')
            ->add('especialidades')
            ->add('servicios')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Checkengine\DashboardBundle\Entity\Empresa'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return '';
    }
}

<?php

namespace Checkengine\DashboardBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Checkengine\DashboardBundle\Entity\Vehiculo;

class VehiculoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('tipo','choice',array(
                'label'=>'Tipo de vehiculo',
                'empty_value'=>false,
                'choices'=>Vehiculo::getArrayTipo(),
                'preferred_choices'=>Vehiculo::getPreferedTipo(),
                'attr'=>array(
                    'class'=>'validate[required] form-control placeholder',
                    'placeholder'=>'Tipo de vehiculo',
                )))
            ->add('marca','text',array('required'=>false))
            ->add('modelo','text',array('required'=>false))
            ->add('year','text',array('required'=>false))
            ->add('puertas','text',array('required'=>false))
            ->add('cilindros','text',array('required'=>false))
            ->add('kms','text',array('required'=>false))
            ->add('combustible','text',array('required'=>false))
            ->add('transmision','text',array('required'=>false))
            ->add('seguro',null,array('label'=>'Tiene seguro?'))
            ->add('usuario',null,array('required'=>false))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Checkengine\DashboardBundle\Entity\Vehiculo'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'checkengine_dashboardbundle_vehiculo';
    }
}

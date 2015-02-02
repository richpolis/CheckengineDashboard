<?php

namespace Checkengine\DashboardBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class OfertaType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titulo','text',array('required'=>false))
            ->add('descripcion',null,array('required'=>false))
            ->add('tipo','hidden')
            ->add('tipoOferta','text',array('required'=>false))
            ->add('oferta','text',array('required'=>false))
            ->add('banner','hidden')
            ->add('inicia','text',array('required'=>false))
            ->add('termina')
            ->add('tipoPago')
            ->add('marcas')
            ->add('modelos')
            ->add('clicks')
            ->add('usuario')
            ->add('sucursales')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Checkengine\DashboardBundle\Entity\Oferta'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'checkengine_dashboardbundle_oferta';
    }
}

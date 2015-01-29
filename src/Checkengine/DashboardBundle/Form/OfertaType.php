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
            ->add('titulo')
            ->add('descripcion')
            ->add('tipo')
            ->add('tipoOferta')
            ->add('oferta')
            ->add('banner')
            ->add('inicia')
            ->add('termina')
            ->add('tipoPago')
            ->add('marcas')
            ->add('modelos')
            ->add('clicks')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('usuario')
            ->add('sucursales')
            ->add('comentarios')
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

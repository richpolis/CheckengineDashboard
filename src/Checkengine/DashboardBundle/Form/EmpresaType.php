<?php

namespace Checkengine\DashboardBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EmpresaType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('sucursal')
            ->add('direccion')
            ->add('rut')
            ->add('region')
            ->add('comuna')
            ->add('horarios')
            ->add('imagen')
            ->add('ubicacionLongitud')
            ->add('ubicacionLatitutd')
            ->add('isActive')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('usuario')
            ->add('tipos')
            ->add('especialidades')
            ->add('comentarios')
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
        return 'checkengine_dashboardbundle_empresa';
    }
}

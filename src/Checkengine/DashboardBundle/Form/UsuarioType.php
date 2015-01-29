<?php

namespace Checkengine\DashboardBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UsuarioType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('apellidos')
            ->add('imagen')
            ->add('email')
            ->add('password')
            ->add('salt')
            ->add('celular')
            ->add('fechaNacimiento')
            ->add('genero')
            ->add('ubicacionLongitud')
            ->add('ubicacionLatitud')
            ->add('noOfertas')
            ->add('isActive')
            ->add('grupo')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('facebook_id')
            ->add('facebook_access_token')
            ->add('amigos')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Checkengine\DashboardBundle\Entity\Usuario'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'checkengine_dashboardbundle_usuario';
    }
}

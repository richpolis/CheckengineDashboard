<?php

namespace Checkengine\DashboardBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Checkengine\DashboardBundle\Entity\Usuario;

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
            ->add('apellidos','text',array('required'=>false))
            ->add('imagen','hidden')
            ->add('region','text',array('required'=>false))
            ->add('comuna','text',array('required'=>false))
            ->add('email')
            ->add('password','password',array('required'=>false))
            ->add('salt','hidden')
            ->add('celular','text',array('required'=>false))
            ->add('fechaNacimiento')
            ->add('genero','choice',array(
                'label'=>'Genero',
                'empty_value'=>false,
                'choices'=>Usuario::getArrayGenero(),
                'preferred_choices'=>Usuario::getPreferedGenero(),
                'attr'=>array(
                    'class'=>'validate[required] form-control placeholder',
                    'placeholder'=>'Grupo',
                )))
            ->add('ubicacionLongitud','text',array('required'=>false))
            ->add('ubicacionLatitud','text',array('required'=>false))
            ->add('noOfertas','hidden')
            ->add('isActive')
            ->add('grupo','choice',array(
                'label'=>'Grupo',
                'empty_value'=>false,
                'choices'=>Usuario::getArrayTipoGrupo(),
                'preferred_choices'=>Usuario::getPreferedTipoGrupo(),
                'attr'=>array(
                    'class'=>'validate[required] form-control placeholder',
                    'placeholder'=>'Grupo',
                )))
            ->add('facebook_id','hidden')
            ->add('facebook_access_token','hidden')
            ->add('tokenCelular','hidden')
            ->add('marcaCelular','hidden')   
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

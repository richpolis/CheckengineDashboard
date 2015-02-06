<?php

namespace Checkengine\DashboardBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Checkengine\DashboardBundle\Entity\Oferta;

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
            ->add('tipoOferta','choice',array(
                'label'=>'Tipo de oferta',
                'empty_value'=>false,
                'choices'=>Oferta::getArrayTipoOferta(),
                'preferred_choices'=>Oferta::getPreferedTipoOferta(),
                'attr'=>array(
                    'class'=>'validate[required] form-control placeholder',
                    'placeholder'=>'Tipo de oferta',
                )))
            ->add('oferta','text',array('required'=>false))
            ->add('file','file',array('label'=>'Banner','required'=>false))
            ->add('banner','hidden')
            ->add('inicia',null,array('required'=>false))
            ->add('termina',null,array('required'=>false))
            ->add('tipoPago','choice',array(
                'label'=>'Tipo de pago',
                'empty_value'=>false,
                'choices'=>Oferta::getArrayTipoPago(),
                'preferred_choices'=>Oferta::getPreferedTipoPago(),
                'attr'=>array(
                    'class'=>'validate[required] form-control placeholder',
                    'placeholder'=>'Tipo de pago',
                )))
            ->add('marcas',null,array('required'=>false))
            ->add('modelos',null,array('required'=>false))
            ->add('clicks','hidden')
            ->add('usuario','hidden')
            ->add('sucursales',null,array('required'=>false))
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

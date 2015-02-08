<?php

namespace Checkengine\ApiBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Checkengine\DashboardBundle\Form\DataTransformer\UsuarioToNumberTransformer;
//use Checkengine\DashboardBundle\Form\DataTransformer\EmpresaToNumberTransformer;

class ContactoApiType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $em = $options['em'];
        $usuarioTransformer = new UsuarioToNumberTransformer($em);
        //$empresaTransformer = new EmpresaToNumberTransformer($em);
        $builder
            ->add($builder->create('usuario', 'hidden')->addModelTransformer($usuarioTransformer))
            //->add($builder->create('empresa', 'hidden')->addModelTransformer($empresaTransformer))
            ->add('comentarios')
            ->add('isActive','hidden')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Checkengine\DashboardBundle\Entity\Contacto',
            'csrf_protection'   => false,
        ))
        ->setRequired(array('em'))
        ->setAllowedTypes(array('em'=>'Doctrine\Common\Persistence\ObjectManager'))
        ;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return '';
    }
}

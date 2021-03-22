<?php

namespace App\Form;

use App\Entity\Subsidios;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SubsidiosType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('idEstado')
            ->add('idUsuario')
            ->add('idPrograma')
            ->add('fechaCreacion')
            ->add('fechaModificacion')
            ->add('fechaFinalizacion')
            ->add('formulario')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Subsidios::class,
        ]);
    }
}

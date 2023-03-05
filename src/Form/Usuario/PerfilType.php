<?php

namespace App\Form\Usuario;

use App\Entity\Perfil;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PerfilType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre1')
            ->add('nombre2')
            ->add('apellido1')
            ->add('apellido2')
            ->add('celular')
            ->add('correo',EmailType::class, ['label' => 'Correo electronico:', 'required' => true])
            ->add('fechaNacimiento', DateType::class, ['label' => 'Fecha nacimiento: ', 'required' => true, 'widget' => 'single_text', 'format' => 'yyyy-MM-dd'])
            ->add('numeroIdentificacion')
            ->add('btnGuardar', SubmitType::class, ['label' => 'Guardar', 'attr'=>['class'=>'btn btn-primary']]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
            'data_class' => Perfil::class,
        ]);
    }
}

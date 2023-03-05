<?php

namespace App\Form\Usuario;

use App\Entity\Estudio;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EstudioType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre', TextType::class, ['label' => 'Nombre carrera'])
            ->add('institucion', TextType::class, ['label' => 'Donde estudio'])
            ->add('titulo', TextType::class, ['label' => 'Titulo obtenido'])
            ->add('fechaDesde', DateType::class, ['label' => 'Fecha desde: ', 'required' => true, 'widget' => 'single_text', 'format' => 'yyyy-MM-dd'])
            ->add('fechaHasta', DateType::class, ['label' => 'Fecha hasta: ', 'required' => true, 'widget' => 'single_text', 'format' => 'yyyy-MM-dd'])
            ->add('estadoTerminado', CheckboxType::class, ['label' => 'Estudio terminado', 'data'=>true])
            ->add('btnGuardar', SubmitType::class, ['label' => 'Guardar', 'attr' => ['class' => 'btn btn-primary']]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Estudio::class,
        ]);
    }
}
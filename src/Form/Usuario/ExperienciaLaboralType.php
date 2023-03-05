<?php

namespace App\Form\Usuario;

use App\Entity\ExperienciaProfesional;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class ExperienciaLaboralType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('compania', TextType::class, ['label' => 'Compañia'])
            ->add('descripcionCargo', TextareaType::class, ['label' => 'Descripción del cargo'])
            ->add('estadoActivo', CheckboxType::class, ['label' => 'Trabajo actualmenten en esta empresa'])
            ->add('fechaDesde', DateType::class, ['label' => 'Fecha desde: ', 'required' => true, 'widget' => 'single_text', 'format' => 'yyyy-MM-dd'])
            ->add('fechaHasta', DateType::class, ['label' => 'Fecha hasta: ', 'required' => true, 'widget' => 'single_text', 'format' => 'yyyy-MM-dd'])
            ->add('btnGuardar', SubmitType::class, ['label' => 'Guardar', 'attr' => ['class' => 'btn btn-primary']]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ExperienciaProfesional::class,
        ]);
    }
}
<?php

namespace App\Form;

use App\Entity\Categoria;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/** Formulario para la entidad Categoría. */
class CategoriaType extends AbstractType
{
    /** Añade campos necesarios para alta/edición. */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nombre')
            ->add('descripcion', TextareaType::class, ['required' => false]);
    }

    /** Define data_class para mapear automáticamente a Categoria. */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(['data_class' => Categoria::class]);
    }
}

<?php

namespace App\Form;

use App\Entity\Categoria;
use App\Entity\Libro;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/** Formulario para crear/editar libros. */
class LibroType extends AbstractType
{
    /** Construye campos del formulario con etiquetas claras para DAW. */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titulo')
            ->add('autor')
            ->add('descripcion', TextareaType::class)
            ->add('precio', MoneyType::class, ['currency' => 'EUR'])
            ->add('estado')
            ->add('fechaPublicacion', DateType::class, ['widget' => 'single_text'])
            ->add('categoria', EntityType::class, [
                'class' => Categoria::class,
                'choice_label' => 'nombre',
            ]);
    }

    /** Indica que este formulario mapea con la entidad Libro. */
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults(['data_class' => Libro::class]);
    }
}

<?php

namespace App\Form;

use App\Entity\Product;
use App\Entity\Category;
use App\Entity\Subcategory;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('price')
            ->add('category', EntityType::class, [
                    'class' => Category::class,
                    'choice_label' => 'name',
                    'label' => 'Category',
                    'placeholder' => 'Choose a category',
                    'attr' => ['id' => 'product_category']
            ])
            ->add('subcategory', EntityType::class, [
                    'class' => Subcategory::class,
                    'choice_label' => 'name',
                    'label' => 'Subcategory',
                    'placeholder' => 'Choose a subcategory',
                    'required' => false,
                    'attr' => ['id' => 'product_subcategory'],
                    'choices' => [] // Will be populated via AJAX
            ])
            
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}

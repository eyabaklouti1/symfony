<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Product;
use App\Entity\Subcategory;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SubcategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('categories', EntityType::class, [
                'class' => Category::class,
            'choice_label' => 'name',
            'label' => 'Categories',
            'placeholder' => 'Choose a category',
             'multiple' => true,           //  Permet de sélectionner plusieurs catégories
            'by_reference' => false       //  Obligatoire pour que addCategory() soit utilisé
            ])

            ->add('product_id', EntityType::class, [
                    'class' => Product::class,
                    'choice_label' => 'name', 
                    'label' => 'Product',
                    'placeholder' => 'Choose a product',
            ])
            
            
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Subcategory::class,

        ]);
    }
}

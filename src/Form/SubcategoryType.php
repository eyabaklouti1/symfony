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
            ->add('category_id', EntityType::class, [
                'class' => Category::class
            ])
            ->add('product_id', EntityType::class, [
                'class' => Product::class
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

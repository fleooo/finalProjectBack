<?php

namespace App\Form;

use App\Entity\Categories;
use App\Entity\Products;
use App\Repository\CategoriesRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\All;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\Validator\Constraints\Positive;

class ProductsFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('name', options:[
            'label' => 'Nom',
            'attr' => ['class' => 'form-control',
        ],
        ])
        ->add('description')
        ->add('price', MoneyType::class, options:[
            'label' => 'Prix',
            'attr' => ['class' => 'form-control',
        ],
            'divisor' => 100,
            'constraints' => [
                new Positive(
                    message: 'Le prix ne peut être négatif'
                )
            ]
        ])
       
        ->add('categories', EntityType::class, [
            'class' => Categories::class,
            'choice_label' => 'name',
            'label' => 'Catégorie',
            'attr' => ['class' => 'form-control',
        ],
            'group_by' => 'parent.name',
        ])
        ->add('image', FileType::class, [
            'label' => false,
            'multiple' => true,
            'mapped' => false,
            'attr' => ['class' => 'form-control',
        ],
            'required' => false,
            'constraints' => [
                new All(
                    new Image([
                        'maxWidth' => 1280,
                        'maxWidthMessage' => 'L\'image doit faire {{ max_width }} pixels de large au maximum'
                    ])
                )
            ]
        ])
    ;
}

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Products::class,
        ]);
    }
}

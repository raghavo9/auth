<?php

namespace App\Form;

use App\Entity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('product_title' , TextType::class ,['attr'=>[
                                                                'placeholder'=>'enter product title',
                                                                'class'=>'input100'
                                                              ]
                                                     ])
            ->add('product_qty', NumberType::class ,['attr'=>[
                                                                'class'=>'input100',
                                                                'placeholder'=>'enter product quantity'
                                                             ]
                                                    ])
            ->add('product_description',TextareaType::class ,['attr'=>[
                                                                        'class'=>'input100',
                                                                        'placeholder'=>'enter product description'
                                                                      ]
                                                             ])
            ->add('save',SubmitType::class,['attr'=>['class'=>'btn btn-success']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}

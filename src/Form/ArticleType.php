<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('piece')
            ->add('marque')
            ->add('modele')
            ->add('energie', ChoiceType::class, [
                'choices' => [
                    '' => null,
                    'diesel'  => 'diesel',
                    'essence' => 'essence'
                ],
            ])
            ->add('image')
            ->add('disponible', ChoiceType::class, [
                  'choices' => [
                     '' => null,
                     'seul'  => true,
                     'avec son assemblage' => false
                  ],
                ])
            ->add('prix', MoneyType::class)
            ->add('description')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }
}

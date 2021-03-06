<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Menu;
use App\Entity\Recipe;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MenuType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('starter', EntityType::class, [
                'label' => 'Entrée',
                'class' => Recipe::class,
                'query_builder' => function (EntityRepository $er) {
                    $qb = $er->createQueryBuilder('r');
                    return $qb->join('r.category', 'c')
                        ->where($qb->expr()->eq('c.label', ':label'))
                        ->orderBy('r.title')
                        ->setParameter('label', Category::ENTREE);
                },
            ])
            ->add('mainCourse', EntityType::class,[
                'label' => 'Plat principal',
                'class' => Recipe::class,
                'query_builder' => function (EntityRepository $er) {
                    $qb = $er->createQueryBuilder('r');
                    return $qb->join('r.category', 'c')
                        ->where($qb->expr()->eq('c.label', ':label'))
                        ->orderBy('r.title')
                        ->setParameter('label', Category::PLAT);
                },
            ])
            ->add('dessert', EntityType::class,[
                'label' => 'Dessert',
                'class' => Recipe::class,
                'query_builder' => function (EntityRepository $er) {
                    $qb = $er->createQueryBuilder('r');
                    return $qb->join('r.category', 'c')
                        ->where($qb->expr()->eq('c.label', ':label'))
                        ->orderBy('r.title')
                        ->setParameter('label', Category::DESSERT);
                },
            ])
            ->add('user', null, [
                'label' => 'Utilisateur']
            )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Menu::class,
        ]);
    }
}

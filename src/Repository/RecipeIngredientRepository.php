<?php
/**
 * Created by PhpStorm.
 * User: CAP2
 * Date: 02/05/2019
 * Time: 11:21
 */

namespace App\Repository;


use App\Entity\RecipeIngredient;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class RecipeIngredientRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, RecipeIngredient::class);
    }

    public function groupIngredientBy()
    {
        $qb = $this->createQueryBuilder('recipe_ingredient');

        $qb = $qb
            ->innerJoin('recipe_ingredient.ingredient', 'i')
            ->innerJoin('recipe_ingredient.unit', 'u')
            ->groupBy('recipe_ingredient.id');


        return $qb->getQuery()->getResult();
    }
}

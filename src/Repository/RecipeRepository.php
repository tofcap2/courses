<?php

namespace App\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class RecipeRepository
 * @package App\Repository
 */
class RecipeRepository extends ServiceEntityRepository
{
/*
    public function findPictureByRecipe($id): array
    {
        $qb = $this->createQueryBuilder('p');
        $qb->join('p.recipe', 'r');

        return $qb->getQuery()->getResult();
    }
*/
}

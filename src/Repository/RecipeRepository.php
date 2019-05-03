<?php

namespace App\Repository;


use App\Entity\Recipe;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\RegistryInterface;

class RecipeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Recipe::class);
    }

    public function findLast(int $limit): array
    {
        $qb = $this->createQueryBuilder('r');

        $qb = $qb->select('r')
            ->innerJoin('r.pictures','p')
            ->innerJoin('r.tag', 't')
            ->orderBy('r.id', 'DESC')
            ->setMaxResults($limit);

        return $qb->getQuery()->getResult();
    }

    /**
     * @return Query
     */
    public function findAllVisibleQuery(): Query
    {
        return $this->findVisibleQuery()->getQuery();
    }

    public function findVisibleQuery(): QueryBuilder
    {
        return $this->createQueryBuilder('r');
    }

}

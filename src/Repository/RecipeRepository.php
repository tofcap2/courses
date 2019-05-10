<?php

namespace App\Repository;


use App\Entity\Category;
use App\Entity\Recipe;
use App\Entity\RecipeSearch;
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
     * @param RecipeSearch $search
     * @return Query
     */
    public function findAllVisibleQuery(RecipeSearch $search): Query
    {
        $query = $this->findVisibleQuery();

        if ($search->getCategory()){
            $query = $query
                ->andWhere('r.category = :category')
                ->setParameter('category', $search->getCategory());
        }

        if ($search->getRecipe()){
            $query = $query
                ->andWhere('r = :recipe')
                ->setParameter('recipe', $search->getRecipe());
        }

        return $query->getQuery();
    }

    public function findVisibleQuery(): QueryBuilder
    {
        return $this->createQueryBuilder('r');
    }

    public function searchBy(string $sq)
    {
        $sq = "%$sq%";

        $qb = $this->createQueryBuilder('r');
        $qb = $qb
            ->where($qb->expr()->orX(
                $qb->expr()->like('r.title', ':sq')
            ));
        return $qb->setParameter(':sq', $sq)->getQuery()->getResult();
    }

    public function findByCategory(Category $category): array
    {
        $qb = $this->createQueryBuilder('r');

        $qb->where($qb->expr()->eq('r.category', ':category'));
        $qb->setParameter(':category', $category);

        return $qb->getQuery()->getResult();
    }

}

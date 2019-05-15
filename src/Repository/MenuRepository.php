<?php

namespace App\Repository;

use App\Entity\Menu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\ORM\Query;
use Doctrine\ORM\QueryBuilder;


class MenuRepository extends ServiceEntityRepository

{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Menu::class);
    }

    /**
     * @param $menuid
     * @return mixed
     */
    public function findAllIngredients($menuid) : array
    {
        $qb = $this->createQueryBuilder('m');

        $qb = $qb->select('ingredient.label', 'unit.label')
            ->addSelect('SUM(recipe_ingredient.qte) as iqte')
            ->innerJoin('m.starter', 's')
            ->innerJoin('s.recipe_ingredient', 'ri')
            ->leftJoin('ri.unit', 'u')
            ->leftJoin('ri.ingredient', 'i')
            ->where($qb->expr()->eq('m.id', ':r'))
            ->groupBy('ingredient.label', 'unit.label');

        return $qb->setParameter(':r', $menuid)->getQuery()->getResult();
    }
}

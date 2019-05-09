<?php

namespace App\Repository;

use App\Entity\Menu;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Class MenuRepository
 * @package App\Repository
 * @method Menu
 * @method getDoctrine()
 */
class MenuRepository extends ServiceEntityRepository

{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Menu::class);
    }


    public function searchBy(string $sq)
    {
        $qb = $this->createQueryBuilder('u');
        $qb = $qb
            ->innerJoin('u.genre', 'g')
            ->innerJoin('u.type', 't')
            ->where($qb->expr()->orX(
                $qb->expr()->eq('g.libelle', ':sq'),
                $qb->expr()->eq('u.artistId', ':sq'),
                $qb->expr()->eq('t.libelle', ':sq'),
                $qb->expr()->eq('u.localisation', ':sq'))
            );

        return $qb->setParameter(':sq', $sq)->getQuery()->getResult();
    }

    /**
     * @return mixed
     */
    public function findByIngredient() : array
    {
        $qb = $this->createQueryBuilder('menu');

        $qb = $qb->select('menu', 'recipe', 'recipe_ingredient', 'ingredient', 'unit')
            ->addSelect('SUM(recipe_ingredient.qte) as iqte')
            ->leftJoin('m.recipe', 'r')
            ->leftJoin('r.recipe_ingredient', 'ri')
            ->leftJoin('ri.unit', 'u')
            ->leftJoin('ri.ingredient', 'i')
            ->where($qb->expr()->eq('m.recipe', ':r'))
            ->andwhere($qb->expr()->eq('r.recipe_ingredient', ':ri'))
            ->andwhere($qb->expr()->eq('ri.unit', ':u'))
            ->andwhere($qb->expr()->eq('ri.ingredient', ':i'))

            ->groupBy('ingredient.label');

        return $qb->setParameters([':r' => 'recipe', ':ri' => 'recipe_ingredient', ':u' => 'unit', ':i' => 'ingredient'])->getQuery()->getResult();
    }
}

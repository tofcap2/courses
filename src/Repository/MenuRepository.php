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


}

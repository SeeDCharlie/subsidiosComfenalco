<?php

namespace App\Repository;

use App\Entity\Requerimientos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Requerimientos|null find($id, $lockMode = null, $lockVersion = null)
 * @method Requerimientos|null findOneBy(array $criteria, array $orderBy = null)
 * @method Requerimientos[]    findAll()
 * @method Requerimientos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RequerimientosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Requerimientos::class);
    }

    // /**
    //  * @return Requerimientos[] Returns an array of Requerimientos objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Requerimientos
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

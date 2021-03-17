<?php

namespace App\Repository;

use App\Entity\Subsidios;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Subsidios|null find($id, $lockMode = null, $lockVersion = null)
 * @method Subsidios|null findOneBy(array $criteria, array $orderBy = null)
 * @method Subsidios[]    findAll()
 * @method Subsidios[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SubsidiosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Subsidios::class);
    }

    // /**
    //  * @return Subsidios[] Returns an array of Subsidios objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Subsidios
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

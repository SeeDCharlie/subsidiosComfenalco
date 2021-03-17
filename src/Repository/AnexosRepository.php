<?php

namespace App\Repository;

use App\Entity\Anexos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Anexos|null find($id, $lockMode = null, $lockVersion = null)
 * @method Anexos|null findOneBy(array $criteria, array $orderBy = null)
 * @method Anexos[]    findAll()
 * @method Anexos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AnexosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Anexos::class);
    }

    // /**
    //  * @return Anexos[] Returns an array of Anexos objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Anexos
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

<?php

namespace App\Repository;

use App\Entity\NotiSoli;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method NotiSoli|null find($id, $lockMode = null, $lockVersion = null)
 * @method NotiSoli|null findOneBy(array $criteria, array $orderBy = null)
 * @method NotiSoli[]    findAll()
 * @method NotiSoli[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class NotiSoliRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, NotiSoli::class);
    }

    // /**
    //  * @return NotiSoli[] Returns an array of NotiSoli objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('n.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?NotiSoli
    {
        return $this->createQueryBuilder('n')
            ->andWhere('n.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

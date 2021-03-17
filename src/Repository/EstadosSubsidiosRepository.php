<?php

namespace App\Repository;

use App\Entity\EstadosSubsidios;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EstadosSubsidios|null find($id, $lockMode = null, $lockVersion = null)
 * @method EstadosSubsidios|null findOneBy(array $criteria, array $orderBy = null)
 * @method EstadosSubsidios[]    findAll()
 * @method EstadosSubsidios[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EstadosSubsidiosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EstadosSubsidios::class);
    }

    // /**
    //  * @return EstadosSubsidios[] Returns an array of EstadosSubsidios objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?EstadosSubsidios
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

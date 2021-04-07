<?php

namespace App\Repository;

use App\Entity\ProgramaRequerimientos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ProgramaRequerimientos|null find($id, $lockMode = null, $lockVersion = null)
 * @method ProgramaRequerimientos|null findOneBy(array $criteria, array $orderBy = null)
 * @method ProgramaRequerimientos[]    findAll()
 * @method ProgramaRequerimientos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProgramaRequerimientosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ProgramaRequerimientos::class);
    }


    // /**
    //  * @return ProgramaRequerimientos[] Returns an array of ProgramaRequerimientos objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ProgramaRequerimientos
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

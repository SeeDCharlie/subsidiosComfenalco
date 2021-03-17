<?php

namespace App\Repository;

use App\Entity\EstadosPrograma;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method EstadosPrograma|null find($id, $lockMode = null, $lockVersion = null)
 * @method EstadosPrograma|null findOneBy(array $criteria, array $orderBy = null)
 * @method EstadosPrograma[]    findAll()
 * @method EstadosPrograma[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EstadosProgramaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EstadosPrograma::class);
    }

    // /**
    //  * @return EstadosPrograma[] Returns an array of EstadosPrograma objects
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
    public function findOneBySomeField($value): ?EstadosPrograma
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

<?php

namespace App\Repository;

use App\Entity\Programas;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Programas|null find($id, $lockMode = null, $lockVersion = null)
 * @method Programas|null findOneBy(array $criteria, array $orderBy = null)
 * @method Programas[]    findAll()
 * @method Programas[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ProgramasRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Programas::class);
    }

    // /**
    //  * @return Programas[] Returns an array of Programas objects
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
    public function findOneBySomeField($value): ?Programas
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

<?php

namespace App\Repository;

use App\Entity\Departamentos;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Departamentos|null find($id, $lockMode = null, $lockVersion = null)
 * @method Departamentos|null findOneBy(array $criteria, array $orderBy = null)
 * @method Departamentos[]    findAll()
 * @method Departamentos[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DepartamentosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Departamentos::class);
    }

    public function getAllDepartamentos():array{

        $conn = $this->getEntityManager()->getConnection();
        
        $sql = 'select * from DEPARTAMENTOS';

        $stmt = $conn->prepare($sql);

        $stmt->execute();

        $datos = $stmt->fetchAll();

        return $datos;        
    }    

    // /**
    //  * @return Departamentos[] Returns an array of Departamentos objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Departamentos
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

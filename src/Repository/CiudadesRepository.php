<?php

namespace App\Repository;

use App\Entity\Ciudades;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Ciudades|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ciudades|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ciudades[]    findAll()
 * @method Ciudades[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CiudadesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ciudades::class);
    }

    public function CiudadesByDepartamento(String $departamento):array{

        $conn = $this->getEntityManager()->getConnection();
        
        $sql = 'select * from CIUDADES ciu
        inner join DEPARTAMENTOS dep on (ciu.ID_DEPARTAMENTO = dep.ID_DEPARTAMENTO)
        where dep.DEPARTAMENTO = :departamento';

        $stmt = $conn->prepare($sql);

        $stmt->execute();

        $datos = $stmt->fetchAll();

        return $datos;        
    }      

    public function getAllCiudades():array{

        $conn = $this->getEntityManager()->getConnection();
        
        $sql = 'select * from CIUDADES';

        $stmt = $conn->prepare($sql);

        $stmt->execute();

        $datos = $stmt->fetchAll();

        return $datos;        
    }

    // /**
    //  * @return Ciudades[] Returns an array of Ciudades objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Ciudades
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

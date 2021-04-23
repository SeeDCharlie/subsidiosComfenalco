<?php

namespace App\Repository;

use App\Entity\TiposDocumento;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TiposDocumento|null find($id, $lockMode = null, $lockVersion = null)
 * @method TiposDocumento|null findOneBy(array $criteria, array $orderBy = null)
 * @method TiposDocumento[]    findAll()
 * @method TiposDocumento[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TiposDocumentoRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TiposDocumento::class);
    }

    public function getAllTiposDocumento():array{

        $conn = $this->getEntityManager()->getConnection();
        
        $sql = 'select * from TIPOS_DOCUMENTO';

        $stmt = $conn->prepare($sql);

        $stmt->execute();

        $datos = $stmt->fetchAll();

        return $datos;        
    }  

    // /**
    //  * @return TiposDocumento[] Returns an array of TiposDocumento objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TiposDocumento
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

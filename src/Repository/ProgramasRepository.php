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

    public function getProgramasSQL(): array { 

        $conn = $this->getEntityManager()->getConnection();

        // $sql = 'select pro.PROGRAMA, pro.INFO_PROGRAMA,re.REQUERIMIENTO ,re.INFO_REQUERIMIENTO from PROGRAMAS pro
        // inner join PROGRAMA_REQUERIMIENTOS proRe on (pro.ID_PROGRAMA = proRe.ID_PROGRAMA)
        // inner join REQUERIMIENTOS re on (proRe.ID_REQUERIMIENTOS = re.ID_REQUERIMIENTOS)';

        $sql = 'select pro.ID_PROGRAMA, pro.PROGRAMA, pro.INFO_PROGRAMA from PROGRAMAS pro';


        $stmt = $conn->prepare($sql);

        $stmt->execute();

        $datos = $stmt->fetchAll();

        return $datos;
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

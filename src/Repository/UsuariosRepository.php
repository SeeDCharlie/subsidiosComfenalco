<?php

namespace App\Repository;

use App\Entity\Usuarios;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Usuarios|null find($id, $lockMode = null, $lockVersion = null)
 * @method Usuarios|null findOneBy(array $criteria, array $orderBy = null)
 * @method Usuarios[]    findAll()
 * @method Usuarios[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UsuariosRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Usuarios::class);
    }


    public function getUserSubsidios(int $idUser): array {

        $conn = $this->getEntityManager()->getConnection();

        $sql = 'select estaSub.ESTADO,estaSub.INFO_ESTADO, subsi.FECHA_CREACION, pro.PROGRAMA, usu.NOMBRE, usu.APELLIDO
        from ESTADOS_SUBSIDIOS estaSub
        inner join SUBSIDIOS subsi on (estaSub.ID_ESTADO = subsi.ID_ESTADO)
        inner join USUARIOS usu on (subsi.ID_USUARIO = usu.ID_USUARIO)
        inner join PROGRAMAS pro on (subsi.ID_PROGRAMA = pro.ID_PROGRAMA)
        where usu.ID_USUARIO = :idUser';

        $stmt = $conn->prepare($sql);

        $stmt->execute();

        $datos = $stmt->fetchAll();

        return $datos;

    }

    // /**
    //  * @return Usuarios[] Returns an array of Usuarios objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Usuarios
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

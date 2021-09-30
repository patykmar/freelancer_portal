<?php

namespace App\Repository;

use App\Entity\Sla;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Sla|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sla|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sla[]    findAll()
 * @method Sla[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SlaRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Sla::class);
    }

    // /**
    //  * @return Sla[] Returns an array of Sla objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Sla
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

<?php

namespace App\Repository;

use App\Entity\Ci;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Ci|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ci|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ci[]    findAll()
 * @method Ci[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CiRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ci::class);
    }

    // /**
    //  * @return Ci[] Returns an array of Ci objects
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
    public function findOneBySomeField($value): ?Ci
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

<?php

namespace App\Repository;

use App\Entity\UnpaidWorkItems;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UnpaidWorkItems|null find($id, $lockMode = null, $lockVersion = null)
 * @method UnpaidWorkItems|null findOneBy(array $criteria, array $orderBy = null)
 * @method UnpaidWorkItems[]    findAll()
 * @method UnpaidWorkItems[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UnpaidWorkItemsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UnpaidWorkItems::class);
    }

    // /**
    //  * @return UnpaidWorkItems[] Returns an array of UnpaidWorkItems objects
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
    public function findOneBySomeField($value): ?UnpaidWorkItems
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

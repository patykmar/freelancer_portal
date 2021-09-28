<?php

namespace App\Repository;

use App\Entity\QueueUser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method QueueUser|null find($id, $lockMode = null, $lockVersion = null)
 * @method QueueUser|null findOneBy(array $criteria, array $orderBy = null)
 * @method QueueUser[]    findAll()
 * @method QueueUser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QueueUserRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, QueueUser::class);
    }

    // /**
    //  * @return QueueUser[] Returns an array of QueueUser objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('q.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?QueueUser
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

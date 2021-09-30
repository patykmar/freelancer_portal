<?php

namespace App\Repository;

use App\Entity\GeneralLog;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method GeneralLog|null find($id, $lockMode = null, $lockVersion = null)
 * @method GeneralLog|null findOneBy(array $criteria, array $orderBy = null)
 * @method GeneralLog[]    findAll()
 * @method GeneralLog[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GeneralLogRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GeneralLog::class);
    }

    // /**
    //  * @return GeneralLog[] Returns an array of GeneralLog objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?GeneralLog
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

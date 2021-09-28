<?php

namespace App\Repository;

use App\Entity\GeneralState;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method GeneralState|null find($id, $lockMode = null, $lockVersion = null)
 * @method GeneralState|null findOneBy(array $criteria, array $orderBy = null)
 * @method GeneralState[]    findAll()
 * @method GeneralState[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GeneralStateRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GeneralState::class);
    }

    // /**
    //  * @return GeneralState[] Returns an array of GeneralState objects
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
    public function findOneBySomeField($value): ?GeneralState
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

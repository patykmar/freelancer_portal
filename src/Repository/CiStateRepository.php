<?php

namespace App\Repository;

use App\Entity\CiState;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method CiState|null find($id, $lockMode = null, $lockVersion = null)
 * @method CiState|null findOneBy(array $criteria, array $orderBy = null)
 * @method CiState[]    findAll()
 * @method CiState[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CiStateRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, CiState::class);
    }

    // /**
    //  * @return CiState[] Returns an array of CiState objects
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
    public function findOneBySomeField($value): ?CiState
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

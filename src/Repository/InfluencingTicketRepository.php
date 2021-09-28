<?php

namespace App\Repository;

use App\Entity\InfluencingTicket;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method InfluencingTicket|null find($id, $lockMode = null, $lockVersion = null)
 * @method InfluencingTicket|null findOneBy(array $criteria, array $orderBy = null)
 * @method InfluencingTicket[]    findAll()
 * @method InfluencingTicket[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class InfluencingTicketRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, InfluencingTicket::class);
    }

    // /**
    //  * @return InfluencingTicket[] Returns an array of InfluencingTicket objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?InfluencingTicket
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

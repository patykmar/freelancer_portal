<?php

namespace App\Repository;

use App\Entity\TicketCloseState;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TicketCloseState|null find($id, $lockMode = null, $lockVersion = null)
 * @method TicketCloseState|null findOneBy(array $criteria, array $orderBy = null)
 * @method TicketCloseState[]    findAll()
 * @method TicketCloseState[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TicketCloseStateRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TicketCloseState::class);
    }

    // /**
    //  * @return TicketCloseState[] Returns an array of TicketCloseState objects
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
    public function findOneBySomeField($value): ?TicketCloseState
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

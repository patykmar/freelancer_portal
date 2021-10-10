<?php

namespace App\Repository;

use App\Entity\WorkInventory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method WorkInventory|null find($id, $lockMode = null, $lockVersion = null)
 * @method WorkInventory|null findOneBy(array $criteria, array $orderBy = null)
 * @method WorkInventory[]    findAll()
 * @method WorkInventory[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class WorkInventoryRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, WorkInventory::class);
    }

    /**
     * @param int $companyId
     * @return array
     */
    public function getAllUnpaidWorkItemByCompanyId(int $companyId): array
    {
        return $this->createQueryBuilder('w')
            ->where('w.company = :compId')
            ->setParameter('compId', $companyId)
            ->getQuery()
            ->execute();
    }


    // /**
    //  * @return WorkInventory[] Returns an array of WorkInventory objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('w.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?WorkInventory
    {
        return $this->createQueryBuilder('w')
            ->andWhere('w.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

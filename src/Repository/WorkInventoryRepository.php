<?php

namespace App\Repository;

use App\Entity\Tariff;
use App\Entity\WorkInventory;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\QueryBuilder;

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
     * @return QueryBuilder
     */
    public function getAllUnpaidWorkItemByCompanyId(int $companyId): QueryBuilder
    {
        return $this->createQueryBuilder('w')
            ->where('w.company = :compId')
            ->setParameter('compId', $companyId);
    }

    /**
     * Return unpaid work items
     * @return QueryBuilder
     */
    public function getAllUnpaidWorkItemGroupByCompany(): QueryBuilder
    {
        return $this->createQueryBuilder('w')
            ->addSelect('sum(w.work_duration) as workDurationTotal')
            ->addSelect('t.price as tariffPrice')
            ->addSelect('(sum(w.work_duration) * t.price) as totalPrice')
            ->where('w.invoice is null')
            ->innerJoin(Tariff::class,'t',Join::WITH,'w.tariff = t.id')
            ->groupBy('w.company, w.tariff');
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

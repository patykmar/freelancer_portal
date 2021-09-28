<?php

namespace App\Repository;

use App\Entity\ServiceCatalog;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ServiceCatalog|null find($id, $lockMode = null, $lockVersion = null)
 * @method ServiceCatalog|null findOneBy(array $criteria, array $orderBy = null)
 * @method ServiceCatalog[]    findAll()
 * @method ServiceCatalog[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ServiceCatalogRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ServiceCatalog::class);
    }

    // /**
    //  * @return ServiceCatalog[] Returns an array of ServiceCatalog objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ServiceCatalog
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

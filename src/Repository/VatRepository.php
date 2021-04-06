<?php

namespace App\Repository;

use App\Entity\Vat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Vat|null find($id, $lockMode = null, $lockVersion = null)
 * @method Vat|null findOneBy(array $criteria, array $orderBy = null)
 * @method Vat[]    findAll()
 * @method Vat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class VatRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vat::class);
    }

    /** Set is_default to FALSE for each rows */
    public function unsetDefaultAll(): bool
    {

        $conn = $this->getEntityManager()->getConnection();

        $sql = "UPDATE vat SET is_default = :param";

        $stmt = $conn->prepare($sql);
        $stmt->execute(['param' => false]);

        return true;
        //$qb = $this->createQueryBuilder

    }

    // /**
    //  * @return Vat[] Returns an array of Vat objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('v.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Vat
    {
        return $this->createQueryBuilder('v')
            ->andWhere('v.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}

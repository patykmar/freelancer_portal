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
class VatRepository extends ServiceEntityRepository implements DefaultValueInterface
{

    private const TABLE_NAME = 'vat';
    private const TABLE_ID = 'id';

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Vat::class);
    }

    /**
     * Return count of rows
     * @return mixed
     */
    public function getCount()
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('count(v.id)')
            ->from(Vat::class, 'v');

        return $qb->getQuery()->getSingleScalarResult();
    }


    /**
     * Return default entry or null
     * @return Vat|null Description
     */
    public function getDefaultEntity(): ?Vat
    {
        return $this->findOneBy(array('isDefault' => true));
    }

    /**
     * Set is_default to FALSE for each rows
     */
    public function unsetDefaultAll(): bool
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->update(Vat::class, 'v')
            ->set('v.isDefault', '?0')
            ->getQuery()
            ->setParameter(0, FALSE)
            ->execute();
        return true;
    }


    /**
     * Return one row of table where ID is not ID in parameter
     * @param int $id of deleting row
     * @return mixed
     */
    public function findOneRow(int $id)
    {
        $qb = $this->createQueryBuilder('v')
            ->where('v.id != :id')
            ->setMaxResults(1)
            ->setParameter('id', $id);

        return $qb->getQuery()->execute();
    }

    /**
     * Set is_default = true by row ID
     * @param int $id
     */
    public function setIsDefaultById(int $id)
    {
        $conn = $this->getEntityManager()->getConnection();
        $conn->update(self::TABLE_NAME, ['is_default' => TRUE], ['id' => $id]);
    }

}

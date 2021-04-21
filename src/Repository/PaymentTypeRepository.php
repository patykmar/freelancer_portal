<?php

namespace App\Repository;

use App\Entity\PaymentType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PaymentType|null find($id, $lockMode = null, $lockVersion = null)
 * @method PaymentType|null findOneBy(array $criteria, array $orderBy = null)
 * @method PaymentType[]    findAll()
 * @method PaymentType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PaymentTypeRepository extends ServiceEntityRepository implements DefaultValueInterface
{

    private const TABLE_ID = 'id';

    private const TABLE_NAME = 'payment_type';

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PaymentType::class);
    }


    /**
     * Return count of rows
     * @return mixed
     */
    public function getCount()
    {
        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb->select('count(:id)')
            ->from(':tableName')
            ->setParameters([
                'id' => self::TABLE_ID,
                'tableName' => self::TABLE_NAME,
            ]);

        return $qb->getQuery()->getSingleScalarResult();
    }

    /**
     * Return default entry or null
     * @return PaymentType|null
     */
    public function getDefaultEntity()
    {
        return $this->findOneBy(array('isDefault' => true));
    }

    /** Set is_default to FALSE for each rows
     * @throws \Doctrine\DBAL\Driver\Exception
     */
    public function unsetDefaultAll(): bool
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = "UPDATE :table SET is_default = :isDefualt";

        $stmt = $conn->prepare($sql);
        $stmt->execute([
            'table' => self::TABLE_NAME,
            'isDefualt' => false,
        ]);

        return true;
    }

    /**
     * @return mixed
     */
    public function findOneRow(int $id)
    {
        $qb = $this->createQueryBuilder('pt')
            ->where('pt.id != :id')
            ->setMaxResults(1)
            ->setParameter('id', $id);

        return $qb->getQuery()->execute();
    }

    /**
     * @param int $id
     * @return mixed
     */
    public function setIsDefaultById(int $id)
    {
        $conn = $this->getEntityManager()->getConnection();
        $conn->update(self::TABLE_NAME, ['is_default' => TRUE], ['id' => $id]);
    }
}

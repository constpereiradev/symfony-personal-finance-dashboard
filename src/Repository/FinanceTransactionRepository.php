<?php

namespace App\Repository;

use App\Entity\FinanceTransaction;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<FinanceTransaction>
 */
class FinanceTransactionRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FinanceTransaction::class);
    }

    public function findAll(): array
    {
        return parent::findAll();
    }

    public function store(FinanceTransaction $financeTransaction): FinanceTransaction
    {
        $this->getEntityManager()->persist($financeTransaction);
        $this->getEntityManager()->flush();

        return $financeTransaction;
    }

    public function findById(int $id): ?FinanceTransaction
    {
        return parent::find($id);
    }

    public function update(FinanceTransaction $financeTransaction)
    {
        $this->getEntityManager()->persist($financeTransaction);
        $this->getEntityManager()->flush();

        return $financeTransaction;
    }

    public function destroy(FinanceTransaction $financeTransaction): void
    {
        $this->getEntityManager()->remove($financeTransaction);
        $this->getEntityManager()->flush();
    }

    //    /**
    //     * @return FinanceTransaction[] Returns an array of FinanceTransaction objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('f')
    //            ->andWhere('f.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('f.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?FinanceTransaction
    //    {
    //        return $this->createQueryBuilder('f')
    //            ->andWhere('f.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}

<?php

namespace App\Repository;

use App\Entity\FinanceTransaction;
use App\Entity\User;
use App\Enum\FinanceTransactionType;
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

    public function findByUser(int $userId): ?array
    {
        return $this->createQueryBuilder('f')
            ->where('f.user = :userId')
            ->setParameter('userId', $userId)
            ->getQuery()
            ->getResult();
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

    public function getTotalIncome(?User $user = null, ?array $filters = []): array
    {
        $financeTransactions = $this->createQueryBuilder('f')
            ->where('f.type = :type')
            ->setParameter('type', FinanceTransactionType::INCOME);

        if ($user) {
            $financeTransactions = $financeTransactions
                ->andWhere('f.user = :user')
                ->setParameter('user', $user->getId());
        }

        return $financeTransactions->getQuery()
            ->getResult();
    }

    public function getTotalExpense(?User $user = null, ?array $filters = [])
    {
        $financeTransactions = $this->createQueryBuilder('f')
            ->where('f.type = :type')
            ->setParameter('type', FinanceTransactionType::EXPENSE);

        if (!empty($filters['from'])) {
            $financeTransactions = $financeTransactions
                ->andWhere('f.date >= :date')
                ->setParameter('date', $filters['from']);
        }

        if (!empty($filters['to'])) {
            $financeTransactions = $financeTransactions
                ->andWhere('f.date <= :date')
                ->setParameter('date', $filters['to']);
        }

        if ($user) {
            $financeTransactions = $financeTransactions
                ->andWhere('f.user = :user')
                ->setParameter('user', $user->getId());
        }

        return $financeTransactions->getQuery()
            ->getResult();
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

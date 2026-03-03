<?php

namespace App\Services;

use App\DTOs\FinanceTransaction\CreateFinanceTransactionDto;
use App\Entity\FinanceTransaction;
use App\Repository\FinanceTransactionRepository;

class FinanceTransactionService
{
    public function __construct(private readonly FinanceTransactionRepository $financeTransactionRepository) {}

    public function registerFinanceTransaction(CreateFinanceTransactionDto $data): FinanceTransaction
    {
        $financeTransaction = new FinanceTransaction();
        $financeTransaction->setTitle($data->title);
        $financeTransaction->setValue($data->value);
        $financeTransaction->setDate(new \DateTime());
        $financeTransaction->setType($data->type);
        $financeTransaction->setCategory($data->category);

        return $this->financeTransactionRepository->store($financeTransaction);
    }
}

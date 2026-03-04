<?php

namespace App\Services;

use App\DTOs\FinanceTransaction\CreateFinanceTransactionDto;
use App\DTOs\FinanceTransaction\UpdateFinanceTransactionDto;
use App\Entity\FinanceTransaction;
use App\Repository\FinanceTransactionRepository;

class FinanceTransactionService 
{
    public function __construct(private readonly FinanceTransactionRepository $financeTransactionRepository) {}

    public function getAll()
    {
        $financeTransactions = $this->financeTransactionRepository->findAll();

        return array_map(function (FinanceTransaction $transaction) {
            return [
                'id' => $transaction->getId(),
                'title' => $transaction->getTitle(),
                'value' => $transaction->getValue(),
                'type' => $transaction->getType()->value,
                'category' => $transaction->getCategory()->value,
                'date' => $transaction->getDate()
            ];
        }, $financeTransactions);
    }

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

    public function findFinanceTransactionByIdOrFail(int $id): ?FinanceTransaction
    {

        $financeTransaction = $this->financeTransactionRepository->findById($id);

        if (!$financeTransaction) {
            throw new \DomainException('Transaction not found');
        }

        return $financeTransaction;
    }

    public function update(FinanceTransaction $financeTransaction, UpdateFinanceTransactionDto $data): FinanceTransaction
    {
        if(!empty($data->title)){
            $financeTransaction->setTitle($data->title);
        }

        if(!empty($data->value)){
            $financeTransaction->setValue((float) $data->value);
        }

        if(!empty($data->type)){
            $financeTransaction->setType($data->type);
        }

        if(!empty($data->category)){
            $financeTransaction->setCategory($data->category);
        }

        return $this->financeTransactionRepository->update($financeTransaction, $data);
    }
}

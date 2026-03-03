<?php

namespace App\Controller;

use App\DTOs\FinanceTransaction\CreateFinanceTransactionDto;
use App\Entity\FinanceTransaction;
use App\Enum\FinanceTransactionCategory;
use App\Enum\FinanceTransactionType;
use App\Services\FinanceTransactionService;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/api/finance-transaction', name: 'app_finance_transaction')]
final class FinanceTransactionController extends AbstractController
{
    public function __construct(private readonly FinanceTransactionService $financeTransactionService) {}

    #[Route('', methods: ['POST'])]
    public function create(ValidatorInterface $validator, Request $request): JsonResponse
    {
        $data = $request->toArray();
        $dto = new CreateFinanceTransactionDto();
        $dto->title = $data['title'] ?? null;
        $dto->value = $data['value'] ?? null;
        $dto->type = isset($data['type'])
            ? FinanceTransactionType::tryFrom($data['type'])
            : null;

        $dto->category = isset($data['category'])
            ? FinanceTransactionCategory::tryFrom($data['category'])
            : null;



        $errors = $validator->validate($dto);

        if (count($errors) > 0) {

            return $this->json([
                'errors' => $this->formatErrors($errors),
            ], 400);
        }

        $financeTransaction = $this->financeTransactionService->registerFinanceTransaction($dto);

        return $this->json([
            'message' => 'Finance transaction created successfully!',
            'finance_transaction' => $financeTransaction->toArray(),
        ]);
    }
}

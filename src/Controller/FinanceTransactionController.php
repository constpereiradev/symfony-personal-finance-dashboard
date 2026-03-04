<?php

namespace App\Controller;

use App\DTOs\FinanceTransaction\CreateFinanceTransactionDto;
use App\DTOs\FinanceTransaction\UpdateFinanceTransactionDto;
use App\Enum\FinanceTransactionCategory;
use App\Enum\FinanceTransactionType;
use App\Repository\FinanceTransactionRepository;
use App\Services\FinanceTransactionService;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Validator\Validator\ValidatorInterface;

#[Route('/api/finance-transaction', name: 'app_finance_transaction')]
final class FinanceTransactionController extends Controller
{

    /**
     * TODO: Customizar try/catch. 
     * Padronizar msgs de sucesso / erro
     * Padronizar status code. 
     * Retornar transações do usuário logado.
     * Pegar exceções no try catch
     */
    public function __construct(
        private readonly FinanceTransactionService $financeTransactionService,
        private readonly FinanceTransactionRepository $financeTransactionRepository
    ) {}

    #[Route('', methods: ['GET'])]
    public function index(): JsonResponse
    {
        try {
            $financeTransactions = $this->financeTransactionService->getAll();

            return $this->json([
                'finance_transactions' => $financeTransactions,
            ]);
        } catch (\Exception $e) {
            return $this->json([
                'error' => $e->getMessage()
            ]);
        }
    }


    #[Route('', methods: ['POST'])]
    public function create(ValidatorInterface $validator, Request $request): JsonResponse
    {
        try {
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
            ], 203);
        } catch (\Exception $e) {
            return $this->json([
                'error' => $e->getMessage()
            ]);
        }
    }

    #[Route('/{id}', methods: ['PUT'])]
    public function update(Request $request, int $id)
    {
        try {
            $data = $request->toArray();
            $dto = new UpdateFinanceTransactionDto();
            $dto->title = $data['title'] ?? null;
            $dto->value = $data['value'] ?? null;
            $dto->type = isset($data['type']) ?
                FinanceTransactionType::tryFrom($data['type']) : null;
            $dto->category = isset($data['category']) ?
                FinanceTransactionCategory::tryFrom($data['category']) : null;


            $financeTransaction = $this->financeTransactionService->findFinanceTransactionByIdOrFail($id);
            $updatedFinanceTransaction = $this->financeTransactionService->update($financeTransaction, $dto);

            return $this->json([
                'message' => 'Finance transaction updated successfully!',
                'finance_transaction' => $updatedFinanceTransaction->toArray()
            ]);
        } catch (\Exception $e) {
            return $this->json([
                'error' => $e->getMessage()
            ]);
        }
    }

    #[Route('/{id}', methods: ['DELETE'])]
    public function destroy(int $id)
    {
        try {
            $financeTransaction = $this->financeTransactionService->findFinanceTransactionByIdOrFail($id);
            $this->financeTransactionRepository->destroy($financeTransaction);

            return $this->json([
                'message' => 'Finance transaction deleted successfully!'
            ], 200);
        } catch (\Exception $e) {
            return $this->json([
                'error' => $e->getMessage()
            ]);
        }
    }
}

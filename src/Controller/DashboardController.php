<?php

namespace App\Controller;

use App\Services\FinanceTransactionService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/api/dashboard', name: 'app_dashboard')]
final class DashboardController extends AbstractController
{
    public function __construct(
        private readonly FinanceTransactionService $financeTransactionService
    ) {}

    #[Route('', methods: ['GET'])]
    public function userSummary(Request $request): JsonResponse
    {
        $data = $request->query->all();

        return $this->json([
            'message' => 'Success',
            'sumarry' => $this->financeTransactionService->getUserSumarry($data)
        ]);
    }
}

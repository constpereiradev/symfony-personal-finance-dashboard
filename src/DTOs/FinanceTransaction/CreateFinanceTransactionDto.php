<?php

namespace App\DTOs\FinanceTransaction;

use App\Enum\FinanceTransactionCategory;
use App\Enum\FinanceTransactionType;
use Symfony\Component\Validator\Constraints as Assert;

class CreateFinanceTransactionDto
{
    #[Assert\NotBlank]
    public ?string $title = null;

    #[Assert\NotNull]
    public ?float $value = null;

    #[Assert\NotBlank]
    public ?FinanceTransactionType $type = null;

    #[Assert\NotBlank]
    public ?FinanceTransactionCategory $category = null;
}

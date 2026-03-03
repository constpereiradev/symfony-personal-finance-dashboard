<?php

namespace App\Enum;

enum FinanceTransactionCategory: string
{
    case FOOD = "food";
    case ENTERTAINMENT = "entertainment";
    case SALARY = "salary";
    case HEALTHCARE = "healthcare";
}
<?php

namespace App\Enum;

enum FinanceTransactionType: string 
{
    case EXPENSE = 'expense';
    case INCOME = 'income';
}
<?php

namespace App\Enum;

enum FinanceTransactionCategory: string
{
        // Receitas
    case SALARY = "salary";
    case FREELANCE = "freelance";
    case INVESTMENTS = "investments";
    case OTHER_INCOME = "other_income";

        // Moradia
    case RENT = "rent";
    case UTILITIES = "utilities"; // luz, água, gás
    case INTERNET = "internet";
    case CONDOMINIUM = "condominium";

        // Alimentação
    case FOOD = "food";
    case RESTAURANT = "restaurant";

        // Transporte
    case TRANSPORT = "transport";
    case FUEL = "fuel";
    case PUBLIC_TRANSPORT = "public_transport";

        // Saúde
    case HEALTHCARE = "healthcare";
    case PHARMACY = "pharmacy";

        // Financeiro
    case CREDIT_CARD = "credit_card";
    case TAXES = "taxes";

        // Estilo de vida
    case ENTERTAINMENT = "entertainment";
    case SHOPPING = "shopping";
    case EDUCATION = "education";
    case SUBSCRIPTIONS = "subscriptions";

        // Outros
    case OTHER = "other";
}

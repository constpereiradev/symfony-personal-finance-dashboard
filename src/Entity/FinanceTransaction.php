<?php

namespace App\Entity;

use App\Enum\FinanceTransactionCategory;
use App\Enum\FinanceTransactionType;
use App\Repository\FinanceTransactionRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: FinanceTransactionRepository::class)]
class FinanceTransaction
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    private ?string $title = null;

    #[ORM\Column]
    #[Assert\NotNull]
    private ?float $value = null;

    #[ORM\Column(enumType: FinanceTransactionType::class)]
    #[Assert\NotBlank]
    private ?FinanceTransactionType $type = null;

    #[ORM\Column]
    #[Assert\NotBlank]
    private ?\DateTime $date = null;

    #[ORM\Column(enumType: FinanceTransactionCategory::class)]
    #[Assert\NotBlank]
    private ?FinanceTransactionCategory $category = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getValue(): ?float
    {
        return $this->value;
    }

    public function setValue(float $value): static
    {
        $this->value = $value;

        return $this;
    }

    public function getType(): ?FinanceTransactionType
    {
        return $this->type;
    }

    public function setType(FinanceTransactionType $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getDate(): ?\DateTime
    {
        return $this->date;
    }

    public function setDate(\DateTime $date): static
    {
        $this->date = $date;

        return $this;
    }

    public function getCategory(): ?FinanceTransactionCategory
    {
        return $this->category;
    }

    public function setCategory(FinanceTransactionCategory $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
            'title' => $this->getTitle(),
            'value' => (float) $this->getValue(),
            'type' => $this->getType(),
            'category' => $this->getCategory()
        ];
    }
}

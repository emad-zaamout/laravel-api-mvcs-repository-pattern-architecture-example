<?php

declare(strict_types=1);

namespace App\Modules\Students;

class Students
{
    private ?int $id;
    private string $name;
    private string $email;
    private ?string $deletedAt;
    private string $createdAt;
    private ?string $updatedAt;

    function __construct(
        ?int $id,
        string $name,
        string $email,
        ?string $deletedAt,
        string $createdAt,
        ?string $updatedAt
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->deletedAt = $deletedAt;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public function toArray(): array {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "email" => $this->email,
            "deletedAt" => $this->deletedAt,
            "createdAt" => $this->createdAt,
            "updatedAt" => $this->updatedAt,
        ];
    }

    public function toSQL(): array {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "email" => $this->email,
            "deleted_at" => $this->deletedAt,
            "created_at" => $this->createdAt,
            "updated_at" => $this->updatedAt,
        ];
    }
    public function getId(): ?int
    {
        return $this->id;
    }
    public function getName(): string
    {
        return $this->name;
    }
    public function getEmail(): string
    {
        return $this->email;
    }
    public function getDeletedAt(): ?string
    {
        return $this->deletedAt;
    }
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }
    public function getUpdatedAt(): ?string
    {
        return $this->updatedAt;
    }
}

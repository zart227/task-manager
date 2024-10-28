<?php
namespace Arthur\TaskManager\Models;

/**
 * Класс, представляющий задачу.
 */
class Task
{
    private int $id;
    private string $name;
    private string $description;
    private int $userId;
    private ?int $parentId;
    private string $status;
    private string $createdAt;
    private string $updatedAt;

    public function __construct(
        string $name,
        string $description,
        int $userId,
        ?int $parentId = null,
        string $status = 'in_progress',
        string $createdAt = '',
        string $updatedAt = '',
        int $id = 0
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->userId = $userId;
        $this->parentId = $parentId;
        $this->status = $status;
        $this->createdAt = $createdAt ?: date('Y-m-d H:i:s');
        $this->updatedAt = $updatedAt ?: date('Y-m-d H:i:s');
    }

    // Геттеры и сеттеры для всех полей

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function getParentId(): ?int
    {
        return $this->parentId;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): string
    {
        return $this->updatedAt;
    }

    // Методы для обновления свойств (если это нужно)

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    public function setStatus(string $status): void
    {
        $this->status = $status;
    }

    public function setParentId(?int $parentId): void
    {
        $this->parentId = $parentId;
    }

    public function setUpdatedAt(string $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }
}

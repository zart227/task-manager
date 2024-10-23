<?php
namespace Models;

/**
 * Класс, представляющий задачу.
 */
class Task
{
    private int $id;
    private string $name;
    private ?int $parentId;

    public function __construct(string $name, ?int $parentId = null, int $id = 0)
    {
        $this->id = $id;
        $this->name = $name;
        $this->parentId = $parentId;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getParentId(): ?int
    {
        return $this->parentId;
    }
}

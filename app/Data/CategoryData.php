<?php

namespace App\Data;

final class CategoryData
{
    public function __construct(public readonly string $name) {}

    public static function fromArray(array $data): self
    {
        return new self((string) $data['name']);
    }

    public function toArray(): array
    {
        return ['name' => $this->name];
    }
}

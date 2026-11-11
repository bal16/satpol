<?php

namespace App\Data;

final class SopData
{
    public function __construct(
        public readonly string $title,
        public readonly string $link,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self((string) $data['title'], (string) $data['link']);
    }

    public function toArray(): array
    {
        return ['title' => $this->title, 'link' => $this->link];
    }
}

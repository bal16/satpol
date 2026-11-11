<?php

namespace App\Data;

final class ServiceItemData
{
    public function __construct(
        public readonly string $text,
        public readonly ?string $href,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            text: (string) $data['text'],
            href: isset($data['href']) && $data['href'] !== '' ? (string) $data['href'] : null,
        );
    }

    public function toArray(): array
    {
        return ['text' => $this->text, 'href' => $this->href];
    }
}

<?php

namespace App\Data;

final class ServiceData
{
    public function __construct(
        public readonly string $title,
        public readonly ?string $cardId,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            title: (string) $data['title'],
            cardId: isset($data['card_id']) && $data['card_id'] !== '' ? (string) $data['card_id'] : null,
        );
    }

    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'card_id' => $this->cardId,
        ];
    }
}

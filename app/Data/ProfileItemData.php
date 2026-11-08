<?php

namespace App\Data;

final class ProfileItemData
{
    public function __construct(
        public readonly string $title,
        public readonly string $type,
        public readonly bool $show,
        public readonly ?string $contentText,
        public readonly ?string $body,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            title: (string) $data['title'],
            type: (string) $data['type'],
            show: (bool) ($data['show'] ?? false),
            contentText: isset($data['content_text']) ? (string) $data['content_text'] : null,
            body: isset($data['body']) ? (string) $data['body'] : null,
        );
    }
}

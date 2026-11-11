<?php

namespace App\Data;

final class NewsData
{
    public function __construct(
        public readonly string $title,
        public readonly string $author,
        public readonly string $slug,
        public readonly ?string $body,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            title: (string) $data['title'],
            author: (string) $data['author'],
            slug: (string) $data['slug'],
            body: array_key_exists('body', $data) ? $data['body'] : null,
        );
    }

    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'author' => $this->author,
            'slug' => $this->slug,
            'body' => $this->body,
        ];
    }
}

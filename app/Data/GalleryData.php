<?php

namespace App\Data;

final class GalleryData
{
    public function __construct(
        public readonly string $title,
        public readonly ?int $categoryId,
        public readonly ?string $newCategoryName,
    ) {}

    public static function fromArray(array $data): self
    {
        return new self(
            title: (string) $data['title'],
            categoryId: isset($data['category_id']) && $data['category_id'] !== '' ? (int) $data['category_id'] : null,
            newCategoryName: isset($data['new_category_name']) && $data['new_category_name'] !== '' ? (string) $data['new_category_name'] : null,
        );
    }
}

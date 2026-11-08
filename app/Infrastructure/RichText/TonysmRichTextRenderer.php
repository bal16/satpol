<?php

namespace App\Infrastructure\RichText;

use App\Contracts\RichTextRenderer;

class TonysmRichTextRenderer implements RichTextRenderer
{
    public function toTrixHtml(mixed $richText): string
    {
        if ($richText === null) {
            return '';
        }

        if (is_object($richText) && method_exists($richText, 'toTrixHtml')) {
            return (string) $richText->toTrixHtml();
        }

        return (string) $richText;
    }
}

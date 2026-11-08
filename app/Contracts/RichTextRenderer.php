<?php

namespace App\Contracts;

interface RichTextRenderer
{
    public function toTrixHtml(mixed $richText): string;
}

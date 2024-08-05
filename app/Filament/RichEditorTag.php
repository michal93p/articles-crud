<?php
declare(strict_types=1);

namespace App\Filament;

use Illuminate\Support\Str;

/**
 * @todo Add missing tags
 * Key => tag name for RichEditor filament, value => html tag
 */
enum RichEditorTag: string
{
    case H1 = '<h1>';
    case H2 = '<h2>';
    case BOLD = '<strong>';
    case LINK = '<a>';
    case ITALIC = '<i>';
    case PARAGRAPH = '<p>';
    case NEW_LINE = '<br>';

    public static function getRichEditorTag(RichEditorTag $tag): string
    {
        return lcfirst(Str::studly(Str::lower($tag->name)));
    }

    public static function getHTMLTag(RichEditorTag $tag): string
    {
        return $tag->value;
    }

    public static function getRichEditorTags(RichEditorTag ...$tags): array
    {
        $richEditorTags = [];

        foreach ($tags as $tag) {
            $richEditorTags[] = self::getRichEditorTag($tag);
        }

        return $richEditorTags;
    }

    public static function getHTMLTags(RichEditorTag ...$tags): array
    {
        $htmlTags = [];

        foreach ($tags as $tag) {
            $htmlTags[] = self::getHTMLTag($tag);
        }

        return $htmlTags;
    }

}

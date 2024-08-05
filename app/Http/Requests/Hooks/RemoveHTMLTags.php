<?php
namespace App\Http\Requests\Hooks;

class RemoveHTMLTags
{
    public function __invoke(string $dirtyValue, array $allowedTags = []): string
    {
        return strip_tags(
            $dirtyValue,
            $allowedTags
        );
    }

}

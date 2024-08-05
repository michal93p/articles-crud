<?php
declare(strict_types=1);

use App\Models\Article;

return [
    Article::TITLE_FIELD_NAME => 'tytuł',
    Article::CONTENT_FIELD_NAME => 'treść',
    Article::AUTHOR_FOREIGN_KEY => 'autor',
    Article::PUBLISHED_AT_FIELD_NAME => 'data publikacji',
    Article::IS_PUBLISHED_FIELD_NAME => 'czy jest opublikowany',
];

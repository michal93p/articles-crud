<?php
use App\Models\Article;

return [
    Article::TITLE_FIELD_NAME => 'title',
    Article::CONTENT_FIELD_NAME => 'content',
    Article::AUTHOR_FOREIGN_KEY => 'author',
    Article::PUBLISHED_AT_FIELD_NAME => 'published at',
    Article::IS_PUBLISHED_FIELD_NAME => 'is published',
];

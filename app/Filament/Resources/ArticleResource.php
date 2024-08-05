<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ArticleResource\Pages;
use App\Models\Article;

class ArticleResource extends Resource
{
    protected static ?string $model = Article::class;
    protected static ?string $navigationIcon = 'heroicon-o-newspaper';

    public static function getPages(): array
    {
        return [
            self::PAGE_LIST_NAME => Pages\ListArticles::route(self::PAGE_LIST_ROUTE),
            self::PAGE_CREATE_NAME  => Pages\CreateArticle::route(self::PAGE_CREATE_ROUTE),
            self::PAGE_EDIT_NAME => Pages\EditArticle::route(self::PAGE_EDIT_ROUTE),
        ];
    }

}

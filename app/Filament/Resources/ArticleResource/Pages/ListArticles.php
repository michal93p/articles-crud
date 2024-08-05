<?php

namespace App\Filament\Resources\ArticleResource\Pages;

use App\Filament\Resources\ArticleResource;
use App\Helpers\FieldLabelHelper;
use App\Models\Article;
use Filament\Actions;
use Filament\Tables\Actions\DeleteAction;
use Filament\Tables\Actions\EditAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Actions\BulkActionGroup;
use Filament\Tables\Actions\DeleteBulkAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ListArticles extends ListRecords
{
    protected static string $resource = ArticleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    public function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make(Article::TITLE_FIELD_NAME)->searchable()->sortable()->label(
                    FieldLabelHelper::getTransLabelName(Article::class, Article::TITLE_FIELD_NAME)
                ),
                TextColumn::make(Article::PUBLISHED_AT_FIELD_NAME)->sortable()->label(
                    FieldLabelHelper::getTransLabelName(Article::class, Article::PUBLISHED_AT_FIELD_NAME)
                ),
                IconColumn::make(Article::IS_PUBLISHED_FIELD_NAME)->icon(fn (int $state): string => match ($state) {
                    0 => 'heroicon-o-clock',
                    1 => 'heroicon-o-check-circle',
                })->label(
                    FieldLabelHelper::getTransLabelName(Article::class, Article::IS_PUBLISHED_FIELD_NAME)
                ),
            ])
            ->actions([
                EditAction::make(),
                DeleteAction::make(),
            ])->bulkActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}

<?php

namespace App\Filament\Resources\ArticleResource\Pages;

use App\Filament\RichEditorTag;
use App\Helpers\FieldLabelHelper;
use App\Http\Requests\FormRequest;
use App\Http\Requests\Hooks\RemoveHTMLTags;
use App\Http\Requests\UpsertArticleRequest;
use App\Models\Article;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Illuminate\Support\Facades\App;

trait UpsertArticle
{
    private const FULL_COLUMN_SIZE = 2;

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make(Article::TITLE_FIELD_NAME)
                    ->required()
                    ->minLength(UpsertArticleRequest::VALIDATION_RULES[Article::TITLE_FIELD_NAME][FormRequest::MIN_LENGTH_RULE])
                    ->maxLength(UpsertArticleRequest::VALIDATION_RULES[Article::TITLE_FIELD_NAME][FormRequest::MAX_LENGTH_RULE])
                    ->label(FieldLabelHelper::getTransLabelName(Article::class, Article::TITLE_FIELD_NAME)),
                DateTimePicker::make(Article::PUBLISHED_AT_FIELD_NAME)
                    ->label(FieldLabelHelper::getTransLabelName(Article::class, Article::PUBLISHED_AT_FIELD_NAME)),
                RichEditor::make(Article::CONTENT_FIELD_NAME)
                    ->required()
                    ->columnSpan(self::FULL_COLUMN_SIZE)
                    ->minLength(UpsertArticleRequest::VALIDATION_RULES[Article::CONTENT_FIELD_NAME][FormRequest::MIN_LENGTH_RULE])
                    ->maxLength(UpsertArticleRequest::VALIDATION_RULES[Article::CONTENT_FIELD_NAME][FormRequest::MAX_LENGTH_RULE])
                    ->toolbarButtons(RichEditorTag::getRichEditorTags(
                            ...UpsertArticleRequest::VALIDATION_RULES[Article::CONTENT_FIELD_NAME][FormRequest::ALLOWED_TAGS_RULE]
                        ),
                    )
                    ->label(FieldLabelHelper::getTransLabelName(Article::class, Article::CONTENT_FIELD_NAME)),
            ]);
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data[Article::TITLE_FIELD_NAME] = App::make(RemoveHTMLTags::class)(
            $data[Article::TITLE_FIELD_NAME]);
        $data[Article::CONTENT_FIELD_NAME] = App::make(RemoveHTMLTags::class)(
            $data[Article::CONTENT_FIELD_NAME],
            RichEditorTag::getHTMLTags(...UpsertArticleRequest::VALIDATION_RULES[Article::CONTENT_FIELD_NAME][FormRequest::ALLOWED_TAGS_RULE]));

        return $data;
    }

}

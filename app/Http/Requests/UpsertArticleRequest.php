<?php

namespace App\Http\Requests;

use App\Filament\RichEditorTag;
use App\Helpers\FieldLabelHelper;
use App\Http\Requests\Hooks\RemoveHTMLTags;
use App\Models\Article;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;

class UpsertArticleRequest extends FormRequest
{
    public const VALIDATION_RULES = [
        Article::TITLE_FIELD_NAME => [
            self::MAX_LENGTH_RULE => 100,
            self::MIN_LENGTH_RULE => 10,
        ],
        Article::CONTENT_FIELD_NAME => [
            self::MAX_LENGTH_RULE => self::MAXIMUM_LENGTH_OF_TEXT_COLUMN,
            self::MIN_LENGTH_RULE => 50,
            self::ALLOWED_TAGS_RULE => [
                RichEditorTag::H1,
                RichEditorTag::H2,
                RichEditorTag::BOLD,
                RichEditorTag::LINK,
                RichEditorTag::ITALIC,
                RichEditorTag::NEW_LINE,
                RichEditorTag::PARAGRAPH,
            ]
        ]
    ];

    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            Article::TITLE_FIELD_NAME => [
                'required',
                'min:'.self::VALIDATION_RULES[Article::TITLE_FIELD_NAME][self::MIN_LENGTH_RULE],
                'max:'.self::VALIDATION_RULES[Article::TITLE_FIELD_NAME][self::MAX_LENGTH_RULE],
            ],
            Article::CONTENT_FIELD_NAME => [
                'required',
                'min:'.self::VALIDATION_RULES[Article::CONTENT_FIELD_NAME][self::MIN_LENGTH_RULE],
                'max:'.self::VALIDATION_RULES[Article::CONTENT_FIELD_NAME][self::MAX_LENGTH_RULE],
            ],
            Article::PUBLISHED_AT_FIELD_NAME => [
                'date',
            ]
        ];
    }

    public static function getMinPublishedDate(): Carbon
    {
        return now();
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            Article::CONTENT_FIELD_NAME => App::make(RemoveHTMLTags::class)(
                $this->{Article::CONTENT_FIELD_NAME},
                RichEditorTag::getHTMLTags(...UpsertArticleRequest::VALIDATION_RULES[Article::CONTENT_FIELD_NAME][FormRequest::ALLOWED_TAGS_RULE])),
            Article::TITLE_FIELD_NAME => App::make(RemoveHTMLTags::class)(
                $this->{Article::TITLE_FIELD_NAME}
            ),
        ]);
    }

    public function attributes(): array
    {
        return FieldLabelHelper::getTransLabelsName(Article::class);
    }

}

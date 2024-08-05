<?php

namespace App\Models;

use Doctrine\DBAL\Types\Types;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;

class Article extends Model
{
    use HasFactory;

    public final const TITLE_FIELD_NAME = 'title';
    public final const CONTENT_FIELD_NAME = 'content';
    public final const PUBLISHED_AT_FIELD_NAME = 'published_at';
    public final const AUTHOR_FOREIGN_KEY = 'author_id';
    public final const IS_PUBLISHED_FIELD_NAME = 'is_published';

    public final const TABLE_NAME = 'articles';

    protected $table = self::TABLE_NAME;

    protected $fillable = [
        self::TITLE_FIELD_NAME,
        self::CONTENT_FIELD_NAME,
        self::PUBLISHED_AT_FIELD_NAME,
    ];

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, self::AUTHOR_FOREIGN_KEY);
    }

    protected function casts(): array
    {
        return [
            self::PUBLISHED_AT_FIELD_NAME => Types::DATETIME_MUTABLE,
        ];
    }

    protected function isPublished(): Attribute
    {
        return Attribute::make(
            get: fn(null $value, array $attributes) => $attributes[self::PUBLISHED_AT_FIELD_NAME] <= Carbon::now()
        );
    }

    protected static function booted(): void
    {
        static::creating(function (Article $article) {
            return $article->{Article::AUTHOR_FOREIGN_KEY} = auth()->id();
        });
    }

}

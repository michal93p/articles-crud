<?php

namespace App\Policies;

use App\Models\Article;
use App\Models\User;

final readonly class ArticlePolicy
{
    public function update(User $user, Article $article): bool
    {
        return $this->onlyArticleAuthorCanPerformAction(
            $user,
            $article,
        );
    }

    public function delete(User $user, Article $article): bool
    {
        return $this->onlyArticleAuthorCanPerformAction(
            $user,
            $article,
        );
    }

    private function onlyArticleAuthorCanPerformAction(User $user, Article $article): bool
    {
        return $user->{$user->getKeyName()} === $article->{Article::AUTHOR_FOREIGN_KEY};
    }

}

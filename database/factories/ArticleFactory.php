<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
final class ArticleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            Article::TITLE_FIELD_NAME => fake()->title,
            Article::CONTENT_FIELD_NAME => fake()->text,
            Article::PUBLISHED_AT_FIELD_NAME => $this->getRandomPublicationDate(),
            Article::AUTHOR_FOREIGN_KEY => $this->getRandomUserId(),
        ];
    }

    private function getRandomPublicationDate(): string
    {
        $publicationDateVariants = [
            null,
            Carbon::today()->addDays(rand(1, 365)),
            Carbon::today()->subDays(rand(1, 365)),
            Carbon::now(),
        ];

        return $publicationDateVariants[array_rand($publicationDateVariants)];
    }

    private function getRandomUserId(): int
    {
        $randomUser = User::inRandomOrder()?->first();

        if ($randomUser === null) {
            throw new \Exception('I can\'t get a random user. Check whether the users table is not empty, if so, use the command "php artisan db:seed --class=UserSeeder"');
        }

        return $randomUser->id;
    }

}

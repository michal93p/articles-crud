<?php

namespace Database\Seeders;

use App\Models\Article;
use Illuminate\Database\Seeder;

final class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Article::withoutEvents(function () {
            Article::factory(40)->create();
        });
    }

}

<?php

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create(Article::TABLE_NAME, function (Blueprint $table) {
            $table->id();
            $table->string('title', 100);
            $table->text('content');
            $table->timestamp('published_at')->nullable();
            $table->foreignIdFor(User::class, 'author_id')->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists(Article::TABLE_NAME);
    }
};

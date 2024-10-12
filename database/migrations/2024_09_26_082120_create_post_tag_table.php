<?php

use App\Models\Post;
use App\Models\Tag;
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
        Schema::create('post_tag', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('post_id');
            $table->unsignedBigInteger('tag_id');
            $table->foreign('post_id')->references('id')->on('posts')->cascadeOnDelete();
            $table->foreign('tag_id')->references('id')->on('tags')->cascadeOnDelete();

            $table->unique(['post_id', 'tag_id']);
            
            $table->timestamps();
        });

        // seeder 
        $post = Post::create([
            "content" => "Bitcoin has tumbled from its record high of $58,000 after words from three wise men...",
            "student_id" => "B2203594",
        ]);
        $tags = Tag::whereIn('name', ['finance', 'bitcoin', 'crypto'])->get();
        $post->tags()->attach($tags);


        $post = Post::create([
            "content" => "Bitcoin has tumbled from its record high of $58,000 after words from three wise men...",
            "student_id" => "B2203588",
        ]);
        $tags = Tag::whereIn('name', ['finance'])->get();
        $post->tags()->attach($tags);


        $post = Post::create([
            "content" => "Bitcoin has tumbled from its record high of $58,000 after words from three wise men...",
            "student_id" => "B2203567",
        ]);
        $tags = Tag::whereIn('name', ['finance', 'bitcoin'])->get();
        $post->tags()->attach($tags);


        $post = Post::create([
            "content" => "Bitcoin has tumbled from its record high of $58,000 after words from three wise men...",
            "student_id" => "B2203579",
        ]);
        $tags = Tag::whereIn('name', ['crypto'])->get();
        $post->tags()->attach($tags);


        $post = Post::create([
            "content" => "Bitcoin has tumbled from its record high of $58,000 after words from three wise men...",
            "student_id" => "B2203594",
        ]);
        $tags = Tag::whereIn('name', ['bitcoin', 'crypto'])->get();
        $post->tags()->attach($tags);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('post_tag');
    }
};

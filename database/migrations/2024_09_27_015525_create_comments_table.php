<?php

use App\Models\Comment;
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
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->string('content');
            $table->unsignedBigInteger('post_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('parent_id')->nullable();

            $table->foreign('post_id')->references('id')->on('posts')->cascadeOnDelete();
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('parent_id')->references('id')->on('comments')->cascadeOnDelete();

            $table->timestamps();
        });


        Comment::create([
            "content" => fake()->realText(50),
            "post_id" => 1,
            "user_id" => 1,
            "parent_id" => null
        ]);
        Comment::create([
            "content" => fake()->realText(50),
            "post_id" => 1,
            "user_id" => 1,
            "parent_id" => null
        ]);
        Comment::create([
            "content" => fake()->realText(50),
            "post_id" => 1,
            "user_id" => 1,
            "parent_id" => 1
        ]);
        Comment::create([
            "content" => fake()->realText(50),
            "post_id" => 1,
            "user_id" => 1,
            "parent_id" => 1
        ]);
        Comment::create([
            "content" => fake()->realText(50),
            "post_id" => 1,
            "user_id" => 1,
            "parent_id" => 1
        ]);


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};

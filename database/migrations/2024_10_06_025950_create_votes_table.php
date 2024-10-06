<?php

use App\Models\Vote;
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
        Schema::create('votes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('post_id');
            $table->string('student_id');
            $table->foreign('post_id')->references('id')->on('posts')->cascadeOnDelete();
            $table->foreign('student_id')->references('student_id')->on('users')->cascadeOnDelete();

            $table->unique(['post_id', 'student_id']);
            
            $table->timestamps();
        });


        Vote::create([
            "post_id" => 1,
            "student_id" => "B2203594"
        ]);
        Vote::create([
            "post_id" => 1,
            "student_id" => "B2203593"
        ]);
        Vote::create([
            "post_id" => 1,
            "student_id" => "B2203592"
        ]);

        Vote::create([
            "post_id" => 2,
            "student_id" => "B2203593"
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('votes');
    }
};

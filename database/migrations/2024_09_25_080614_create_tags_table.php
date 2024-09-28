<?php

use App\Models\Tag;
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
        Schema::create('tags', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->timestamps();
        });

        Tag::create([
           "name" => "finance" 
        ]);
        Tag::create([
            "name" => "bitcoin" 
        ]);
        Tag::create([
            "name" => "crypto" 
        ]); 

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tags');
    }
};

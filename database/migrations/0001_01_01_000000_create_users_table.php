<?php

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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('student_id')->unique();
            $table->string('email')->unique();
            $table->string('name');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
        
        User::factory()->create([
            'student_id' => 'B2203567',
            'name' => 'Mai Nhat Minh',
            'password' => Hash::make("123123123"),
            'email' => 'minhb2203567@student.ctu.edu.vn',
        ]);
        User::factory()->create([
            'student_id' => 'B2203588',
            'name' => 'Le Lu Huyen Tran',
            'password' => Hash::make("123123123"),
            'email' => 'tranb2203588@student.ctu.edu.vn',
        ]);
        User::factory()->create([
            'student_id' => 'B2203579',
            'name' => 'La Tri Tam',
            'password' => Hash::make("123123123"),
            'email' => 'tamb2203579@student.ctu.edu.vn',
        ]);
        User::factory()->create([
            'student_id' => 'B2203594',
            'name' => 'Nguyen Hoang Vu',
            'password' => Hash::make("123123123"),
            'email' => 'vub2203594@student.ctu.edu.vn',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};

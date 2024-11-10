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
            $table->string('avatarUrl');

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
            'avatarUrl' => "https://cloud.appwrite.io/v1/avatars/initials?name=Mai+Nhat+Minh&project=672dbd51000b01b68e2b",
            'password' => Hash::make("123123123"),
            'email' => 'minhb2203567@student.ctu.edu.vn',
        ]);
        User::factory()->create([
            'student_id' => 'B2203588',
            'name' => 'Le Lu Huyen Tran',
            'avatarUrl' => "https://cloud.appwrite.io/v1/avatars/initials?name=Le+Lu+Huyen+Tran&project=672dbd51000b01b68e2b",
            'password' => Hash::make("123123123"),
            'email' => 'tranb2203588@student.ctu.edu.vn',
        ]);
        User::factory()->create([
            'student_id' => 'B2203579',
            'name' => 'La Tri Tam',
            'avatarUrl' => "https://cloud.appwrite.io/v1/avatars/initials?name=La+Tri+Tam&project=672dbd51000b01b68e2b",
            'password' => Hash::make("123123123"),
            'email' => 'tamb2203579@student.ctu.edu.vn',
        ]);
        User::factory()->create([
            'student_id' => 'B2203594',
            'name' => 'Nguyen Hoang Vu',
            'avatarUrl' => "https://cloud.appwrite.io/v1/avatars/initials?name=Nguyen+Hoang+Vu&project=672dbd51000b01b68e2b",
            'password' => Hash::make("123123123"),
            'email' => 'vub2203594@student.ctu.edu.vn',
        ]);
        User::factory()->create([
            'student_id' => 'B2203589',
            'name' => 'Nguyen Thi Kim Tran',
            'avatarUrl' => "https://cloud.appwrite.io/v1/avatars/initials?name=Nguyen+Thi+Kim+Tran&project=672dbd51000b01b68e2b",
            'password' => Hash::make("123123123"),
            'email' => 'tranb2203589@student.ctu.edu.vn',
        ]);
        User::factory()->create([
            'student_id' => 'B2203591',
            'name' => 'Ho Dinh Tri',
            'avatarUrl' => "https://cloud.appwrite.io/v1/avatars/initials?name=Ho+Dinh+Tri&project=672dbd51000b01b68e2b",
            'password' => Hash::make("123123123"),
            'email' => 'trib2203591@student.ctu.edu.vn',
        ]);
        User::factory()->create([
            'student_id' => 'B2203570',
            'name' => 'Nguyen Minh Nghi',
            'avatarUrl' => "https://cloud.appwrite.io/v1/avatars/initials?name=Nguyen+Minh+Nghi&project=672dbd51000b01b68e2b",
            'password' => Hash::make("123123123"),
            'email' => 'nghib2203570@student.ctu.edu.vn',
        ]);
        User::factory()->create([
            'student_id' => 'B2203573',
            'name' => 'Tran Gia Phu',
            'avatarUrl' => "https://cloud.appwrite.io/v1/avatars/initials?name=Tran+Gia+Phu&project=672dbd51000b01b68e2b",
            'password' => Hash::make("123123123"),
            'email' => 'phub2203573@student.ctu.edu.vn',
        ]);
        User::factory()->create([
            'student_id' => 'B2203580',
            'name' => 'Tran Hai Thien',
            'avatarUrl' => "https://cloud.appwrite.io/v1/avatars/initials?name=Tran+Hai+Thien&project=672dbd51000b01b68e2b",
            'password' => Hash::make("123123123"),
            'email' => 'thienb2203580@student.ctu.edu.vn',
        ]);
        User::factory()->create([
            'student_id' => 'B2203584',
            'name' => 'Tran Vo Phi Thuong',
            'avatarUrl' => "https://cloud.appwrite.io/v1/avatars/initials?name=Tran+Vo+Phi+Thuong&project=672dbd51000b01b68e2b",
            'password' => Hash::make("123123123"),
            'email' => 'thuongb2203584@student.ctu.edu.vn',
        ]);
        User::factory()->create([
            'student_id' => 'B2203585',
            'name' => 'Cao Minh Tien',
            'avatarUrl' => "https://cloud.appwrite.io/v1/avatars/initials?name=Cao+Minh+Tien&project=672dbd51000b01b68e2b",
            'password' => Hash::make("123123123"),
            'email' => 'tienb2203585@student.ctu.edu.vn',
        ]);
        User::factory()->create([
            'student_id' => 'B2203586',
            'name' => 'Nhan Vinh Tien',
            'avatarUrl' => "https://cloud.appwrite.io/v1/avatars/initials?name=Nhan+Vinh+Tien&project=672dbd51000b01b68e2b",
            'password' => Hash::make("123123123"),
            'email' => 'tienb2203586@student.ctu.edu.vn',
        ]);
        User::factory()->create([
            'student_id' => 'B2203590',
            'name' => 'Nguyen Khac Minh Triet',
            'avatarUrl' => "https://cloud.appwrite.io/v1/avatars/initials?name=Nguyen+Khac+Minh+Triet&project=672dbd51000b01b68e2b",
            'password' => Hash::make("123123123"),
            'email' => 'trietb2203590@student.ctu.edu.vn',
        ]);
        User::factory()->create([
            'student_id' => 'B2203592',
            'name' => 'Pham Luu Khanh Van',
            'avatarUrl' => "https://cloud.appwrite.io/v1/avatars/initials?name=Pham+Luu+Khanh+Van&project=672dbd51000b01b68e2b",
            'password' => Hash::make("123123123"),
            'email' => 'vanb2203592@student.ctu.edu.vn',
        ]);
        User::factory()->create([
            'student_id' => 'B2204954',
            'name' => 'Huynh Tri Nhan',
            'avatarUrl' => "https://cloud.appwrite.io/v1/avatars/initials?name=Huynh+Tri+Nhan&project=672dbd51000b01b68e2b",
            'password' => Hash::make("123123123"),
            'email' => 'nhanb2204954@student.ctu.edu.vn',
        ]);
        User::factory()->create([
            'student_id' => 'B2203560',
            'name' => 'Vo Tran Vu Khoa',
            'avatarUrl' => "https://cloud.appwrite.io/v1/avatars/initials?name=Vo+Tran+Vu+Khoa&project=672dbd51000b01b68e2b",
            'password' => Hash::make("123123123"),
            'email' => 'khoab2203560@student.ctu.edu.vn',
        ]);
        User::factory()->create([
            'student_id' => 'B2203556',
            'name' => 'Nguyen Duc Hung',
            'avatarUrl' => "https://cloud.appwrite.io/v1/avatars/initials?name=Nguyen+Duc+Hung&project=672dbd51000b01b68e2b",
            'password' => Hash::make("123123123"),
            'email' => 'hungb2203556@student.ctu.edu.vn',
        ]);
        User::factory()->create([
            'student_id' => 'B2203552',
            'name' => 'Huynh Tri Hao',
            'avatarUrl' => "https://cloud.appwrite.io/v1/avatars/initials?name=Huynh+Tri+Hao&project=672dbd51000b01b68e2b",
            'password' => Hash::make("123123123"),
            'email' => 'haob2203552@student.ctu.edu.vn',
        ]);
        User::factory()->create([
            'student_id' => 'B2203553',
            'name' => 'Truong Tri Hao',
            'avatarUrl' => "https://cloud.appwrite.io/v1/avatars/initials?name=Truong+Tri+Hao&project=672dbd51000b01b68e2b",
            'password' => Hash::make("123123123"),
            'email' => 'haob2203553@student.ctu.edu.vn',
        ]);
        User::factory()->create([
            'student_id' => 'B2203593',
            'name' => 'Do Tri Vi',
            'avatarUrl' => "https://cloud.appwrite.io/v1/avatars/initials?name=Do+Tri+Vi&project=672dbd51000b01b68e2b",
            'password' => Hash::make("123123123"),
            'email' => 'vib2203593@student.ctu.edu.vn',
        ]);
        User::factory()->create([
            'student_id' => 'ntkhoa@ctu.edu.vn',
            'name' => 'Nguyen Thanh Khoa',
            'avatarUrl' => "https://cloud.appwrite.io/v1/avatars/initials?name=Nguyen+Thanh+Khoa&project=672dbd51000b01b68e2b",
            'password' => Hash::make("123123123"),
            'email' => 'ntkhoa@ctu.edu.vn',
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

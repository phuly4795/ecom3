<?php

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
            $table->string('name');
            $table->string('fullname', 50);
            $table->string('phone', 20);
            $table->string('province_id', 10);
            $table->string('district_id', 10);
            $table->string('ward_id', 10);
            $table->string('address');
            $table->dateTime('birthday');
            $table->string('image');
            $table->text('description');
            $table->text('user_agent');
            $table->text('ip');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

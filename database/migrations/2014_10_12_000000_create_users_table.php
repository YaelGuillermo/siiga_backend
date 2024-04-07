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
            $table->uuid('id')->primary();
            
            $table->string('name');
            $table->string('first_surname');
            $table->string('second_surname');
            $table->date('date_of_birth');
            $table->enum('gender', ['Male', 'Female']);
            $table->string('neighborhood');
            $table->string('street');
            $table->string('phone_number');
            $table->longtext('photo')->nullable();
            $table->string('email')->unique();
            $table->string('google_id')->nullable()->unique(); // Google 
            $table->string('password')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->enum('role', ['Parent', 'Administrator']);
            $table->boolean('status')->default(true);
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

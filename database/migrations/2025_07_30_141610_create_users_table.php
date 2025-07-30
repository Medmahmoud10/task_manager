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
            $table->string('username');
            $table->string('email')->unique()->nullable();
            $table->string('password');
            $table->integer('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('date_of_birth', 10)->nullable(); // Format: d/m/y
            $table->string('bio')->nullable();

            $table->timestamps(); // Optional but recommended
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
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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->integer('priority')->required();
            $table->foreignId('profile_id')->constrained()->references('id')->on('profiles')->cascadeOnDelete();
            $table->foreignId('categorie_id')->constrained()->references('id')->on('categories')->cascadeOnDelete();
            $table->foreignId('user_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
        $table->dropForeign(['profile_id']);
        $table->dropColumn('profile_id');
    });
    }
};
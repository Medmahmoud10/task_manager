<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('permission_role', function (Blueprint $table) { // ← MUST be lowercase
            $table->foreignId('role_id')->constrained()->onDelete('cascade'); // ← lowercase
            $table->foreignId('permission_id')->constrained()->onDelete('cascade');
            $table->primary(['role_id', 'permission_id']); // ← lowercase
        });
    }

    public function down()
    {
        Schema::dropIfExists('permission_role');
    }
};

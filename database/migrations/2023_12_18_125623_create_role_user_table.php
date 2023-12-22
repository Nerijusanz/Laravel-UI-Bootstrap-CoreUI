<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('role_user', function (Blueprint $table) {
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('role_id')->constrained()->cascadeOnDelete();

            $table->index('user_id','role_user_user_id_idx');
            $table->index('role_id','role_user_role_id_idx');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('role_user');
    }
};

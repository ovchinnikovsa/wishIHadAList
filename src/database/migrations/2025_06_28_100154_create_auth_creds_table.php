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
        Schema::create('auth_creds', function (Blueprint $table) {
            $table->id();
            $table->string('foreign_id');
            $table->string('token');
            $table->string('name');
            $table->string('email');
            $table->string('refresh_token')->nullable();
            $table->integer('expires_in')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('auth_creds');
    }
};

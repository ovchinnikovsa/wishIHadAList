<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('auth_creds', function (Blueprint $table) {
            $table->integer('type_id');
            $table->foreign('type_id')->references('id')->on('auth_cred_types');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('auth_creds', function (Blueprint $table) {
            $table->dropForeign('auth_creds_type_id_foreign');
            $table->dropColumn('type_id');
        });
    }
};

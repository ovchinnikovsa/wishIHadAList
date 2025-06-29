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
        // Определяем провайдеры и их ID
        $providers = [
            'google' => 1,
            'yandex' => 2,
        ];

        $now = now()->toDateTimeString();

        foreach ($providers as $provider => $typeId) {
            $column = $provider . '_id';

            DB::table('users')
                ->whereNotNull($column)
                ->orderBy('id')
                ->chunk(500, function ($users) use ($column, $typeId, $now) {
                    $records = [];

                    foreach ($users as $user) {
                        $records[] = [
                            'foreign_id'  => $user->{$column},
                            'name'        => $user->name,
                            'email'       => $user->email,
                            'type_id'     => $typeId,
                            'created_at'  => $now,
                            'updated_at'  => $now,
                            // Остальные поля - NULL
                            'token'         => "",
                            'refresh_token' => "",
                        ];
                    }

                    DB::table('auth_creds')->insert($records);
                });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
//        Schema::table('auth_cred', function (Blueprint $table) {
//            //
//        });
    }
};

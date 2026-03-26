<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('formateurs') && ! Schema::hasColumn('formateurs', 'user_id')) {
            Schema::table('formateurs', function (Blueprint $table) {
                $table->foreignId('user_id')->nullable()->after('id')->constrained('users')->cascadeOnDelete();
            });
        }

        if (Schema::hasTable('apprenants') && ! Schema::hasColumn('apprenants', 'user_id')) {
            Schema::table('apprenants', function (Blueprint $table) {
                $table->foreignId('user_id')->nullable()->after('id')->constrained('users')->cascadeOnDelete();
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasTable('formateurs') && Schema::hasColumn('formateurs', 'user_id')) {
            Schema::table('formateurs', function (Blueprint $table) {
                $table->dropConstrainedForeignId('user_id');
            });
        }

        if (Schema::hasTable('apprenants') && Schema::hasColumn('apprenants', 'user_id')) {
            Schema::table('apprenants', function (Blueprint $table) {
                $table->dropConstrainedForeignId('user_id');
            });
        }
    }
};

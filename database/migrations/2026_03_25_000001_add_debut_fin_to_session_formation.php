<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('session_formation', function (Blueprint $table) {
            if (!Schema::hasColumn('session_formation', 'debut')) {
                $table->date('debut')->nullable()->after('formation_id');
            }
            if (!Schema::hasColumn('session_formation', 'fin')) {
                $table->date('fin')->nullable()->after('debut');
            }
        });
    }

    public function down(): void
    {
        Schema::table('session_formation', function (Blueprint $table) {
            $table->dropColumn(['debut', 'fin']);
        });
    }
};

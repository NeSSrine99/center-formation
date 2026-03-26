<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignId('role_id')->nullable()->after('id')->constrained('roles')->nullOnDelete();
        });

        if (Schema::hasColumn('users', 'role')) {
            $roles = DB::table('roles')->pluck('id', 'name')->toArray();
            DB::table('users')->select('id', 'role')->get()->each(function ($user) use ($roles) {
                if (isset($roles[$user->role])) {
                    DB::table('users')->where('id', $user->id)->update(['role_id' => $roles[$user->role]]);
                }
            });
        }
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropConstrainedForeignId('role_id');
        });
    }
};

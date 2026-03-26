<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('description')->nullable();
            $table->timestamps();
        });

        DB::table('roles')->insert([
            ['name' => 'administrateur', 'description' => 'Admin full access', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'formateur', 'description' => 'Formation instructor', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'apprenant', 'description' => 'Student/learner', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};

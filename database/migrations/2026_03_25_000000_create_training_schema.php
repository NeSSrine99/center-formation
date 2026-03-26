<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('formateurs')) {
            Schema::create('formateurs', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->nullable()->constrained('users')->cascadeOnDelete();
                $table->string('nom');
                $table->string('prenom')->nullable();
                $table->string('email')->unique();
                $table->string('phone')->nullable();
                $table->text('bio')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('apprenants')) {
            Schema::create('apprenants', function (Blueprint $table) {
                $table->id();
                $table->foreignId('user_id')->nullable()->constrained('users')->cascadeOnDelete();
                $table->string('nom');
                $table->string('prenom')->nullable();
                $table->string('email')->unique();
                $table->string('phone')->nullable();
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('formations')) {
            Schema::create('formations', function (Blueprint $table) {
                $table->id();
                $table->string('titre');
                $table->text('description')->nullable();
                $table->integer('duree_jours')->nullable();
                $table->decimal('prix', 10, 2)->default(0);
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('formation_sessions')) {
            Schema::create('formation_sessions', function (Blueprint $table) {
                $table->id();
                $table->string('nom')->nullable();
                $table->date('debut')->nullable();
                $table->date('fin')->nullable();
                $table->integer('capacite')->default(0);
                $table->string('etat')->default('ouverte');
                $table->timestamps();
            });
        }

        if (!Schema::hasTable('formation_formateur')) {
            Schema::create('formation_formateur', function (Blueprint $table) {
                $table->id();
                $table->foreignId('formation_id')->constrained('formations')->cascadeOnDelete();
                $table->foreignId('formateur_id')->constrained('formateurs')->cascadeOnDelete();
                $table->timestamps();
                $table->unique(['formation_id', 'formateur_id']);
            });
        }

        if (!Schema::hasTable('session_formation')) {
            Schema::create('session_formation', function (Blueprint $table) {
                $table->id();
                $table->foreignId('session_id')->constrained('formation_sessions')->cascadeOnDelete();
                $table->foreignId('formation_id')->constrained('formations')->cascadeOnDelete();
                $table->timestamps();
                $table->unique(['session_id', 'formation_id']);
            });
        }

        if (!Schema::hasTable('inscriptions')) {
            Schema::create('inscriptions', function (Blueprint $table) {
                $table->id();
                $table->foreignId('apprenant_id')->constrained('apprenants')->cascadeOnDelete();
                $table->foreignId('session_id')->constrained('formation_sessions')->cascadeOnDelete();
                $table->enum('statut', ['en_attente', 'valide', 'annule'])->default('en_attente');
                $table->dateTime('date_inscription')->default(DB::raw('CURRENT_TIMESTAMP'));
                $table->timestamps();
                $table->unique(['apprenant_id', 'session_id']);
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('inscriptions');
        Schema::dropIfExists('session_formation');
        Schema::dropIfExists('formation_formateur');
        Schema::dropIfExists('sessions');
        Schema::dropIfExists('formations');
        Schema::dropIfExists('apprenants');
        Schema::dropIfExists('formateurs');
    }
};

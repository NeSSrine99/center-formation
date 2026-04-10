<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('inscriptions', function (Blueprint $table) {
            // First, expand the enum to include new values
            $table->enum('statut', ['en_attente', 'valide', 'annule', 'validée', 'refusée'])->default('en_attente')->change();
        });

        // Update existing statut values
        DB::table('inscriptions')->where('statut', 'valide')->update(['statut' => 'validée']);
        DB::table('inscriptions')->where('statut', 'annule')->update(['statut' => 'refusée']);

        Schema::table('inscriptions', function (Blueprint $table) {
            // Drop foreign key constraint
            $table->dropForeign(['session_id']);
            
            // Rename session_id to session_formation_id
            $table->renameColumn('session_id', 'session_formation_id');
            
            // Update statut enum to final
            $table->enum('statut', ['en_attente', 'validée', 'refusée'])->default('en_attente')->change();
            
            // Add paiement
            $table->boolean('paiement')->default(false);
            
            // Add unique constraint
            $table->unique(['apprenant_id', 'session_formation_id']);
            
            // Re-add foreign key
            $table->foreign('session_formation_id')->references('id')->on('sessions_formations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('inscriptions', function (Blueprint $table) {
            // Drop foreign key
            $table->dropForeign(['session_formation_id']);
            
            // Drop unique constraint
            $table->dropUnique(['apprenant_id', 'session_formation_id']);
            
            // Drop paiement
            $table->dropColumn('paiement');
            
            // Expand enum for revert
            $table->enum('statut', ['en_attente', 'valide', 'annule', 'validée', 'refusée'])->default('en_attente')->change();
            
            // Rename back
            $table->renameColumn('session_formation_id', 'session_id');
            
            // Re-add old foreign key
            $table->foreign('session_id')->references('id')->on('sessions_formations')->onDelete('cascade');
        });

        // Revert statut values
        DB::table('inscriptions')->where('statut', 'validée')->update(['statut' => 'valide']);
        DB::table('inscriptions')->where('statut', 'refusée')->update(['statut' => 'annule']);

        Schema::table('inscriptions', function (Blueprint $table) {
            // Revert statut enum
            $table->enum('statut', ['en_attente', 'valide', 'annule'])->default('en_attente')->change();
        });
    }
};

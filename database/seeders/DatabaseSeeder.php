<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Role;
use App\Models\Formation;
use App\Models\FormationSession;
use App\Models\Apprenant;
use App\Models\Formateur;
use App\Models\Inscription;
use App\Models\Paiement;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // --------------------
        // 1️⃣ Roles
        // --------------------
        $roles = ['administrateur', 'formateur', 'apprenant'];
        foreach ($roles as $roleName) {
            Role::firstOrCreate(['name' => $roleName]);
        }

        // --------------------
        // 2️⃣ Admin
        // --------------------
        $admin = User::firstOrCreate(
            ['email' => 'admin@test.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('admin123'),
                'role' => 'administrateur'
            ]
        );

        // --------------------
        // 3️⃣ Formateurs
        // --------------------
        $formateurs = [];
        $formateurUsers = [
            ['name' => 'John Formateur', 'email' => 'john@formateur.com'],
            ['name' => 'Emma Formatrice', 'email' => 'emma@formateur.com'],
        ];

        foreach ($formateurUsers as $fUser) {
            $user = User::firstOrCreate(
                ['email' => $fUser['email']],
                ['name' => $fUser['name'], 'password' => Hash::make('password'), 'role' => 'formateur']
            );

            $formateur = Formateur::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'nom' => explode(' ', $user->name)[0],
                    'prenom' => 'Test',
                    'email' => $user->email,
                    'phone' => '5000' . rand(10, 99)
                ]
            );

            $formateurs[] = $user;
        }

        // --------------------
        // 4️⃣ Apprenants
        // --------------------
        $apprenants = [];
        $apprenantUsers = [
            ['name' => 'Salwa', 'email' => 'salwa@test.com'],
            ['name' => 'Ali', 'email' => 'ali@test.com'],
            ['name' => 'Sara', 'email' => 'sara@test.com'],
            ['name' => 'Mohamed', 'email' => 'mohamed@test.com'],
            ['name' => 'Lina', 'email' => 'lina@test.com'],
        ];

        foreach ($apprenantUsers as $aUser) {
            $user = User::firstOrCreate(
                ['email' => $aUser['email']],
                ['name' => $aUser['name'], 'password' => Hash::make('password'), 'role' => 'apprenant']
            );

            $apprenant = Apprenant::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'nom' => explode(' ', $user->name)[0],
                    'prenom' => 'Test',
                    'email' => $user->email,
                    'phone' => '6000' . rand(10, 99)
                ]
            );

            $apprenants[] = $apprenant;
        }

        // --------------------
        // 5️⃣ Formations & Sessions
        // --------------------
        $sessions = [];

        foreach ($formateurs as $formateurUser) {
            for ($i = 1; $i <= 3; $i++) {
                $formation = Formation::firstOrCreate(
                    ['titre' => "Formation $i de {$formateurUser->name}"],
                    [
                        'description' => "Description de la formation $i de {$formateurUser->name}",
                        'price' => rand(100, 300),
                        'duration' => rand(10, 40)
                    ]
                );

                // Attribuer la formation au formateur
                $formateurModel = Formateur::where('user_id', $formateurUser->id)->first();
                $formateurModel->formations()->syncWithoutDetaching([$formation->id]);

                // 2 Sessions par formation
                for ($j = 1; $j <= 2; $j++) {
                    $session = FormationSession::firstOrCreate(
                        [
                            'formation_id' => $formation->id,
                            'start_date' => Carbon::now()->addDays(rand(1, 30))
                        ],
                        [
                            'end_date' => Carbon::now()->addDays(rand(31, 60)),
                            'etat' => 'ouverte'
                        ]
                    );
                    $sessions[] = $session;
                }
            }
        }

        // --------------------
        // 6️⃣ Inscriptions & Paiements
        // --------------------
        foreach ($apprenants as $apprenant) {
            $randomSessions = collect($sessions)->random(2);
            foreach ($randomSessions as $session) {
                $inscription = Inscription::firstOrCreate(
                    [
                        'apprenant_id' => $apprenant->id,
                        'session_id' => $session->id
                    ],
                    [
                        'statut' => 'valide',
                        'date_inscription' => Carbon::now()->subDays(rand(1, 10))
                    ]
                );

                Paiement::firstOrCreate(
                    [
                        'apprenant_id' => $apprenant->id,
                        'formation_id' => $session->formation->id
                    ],
                    [
                        'amount' => $session->formation->price,
                        'status' => rand(0, 1) ? 'paid' : 'pending'
                    ]
                );
            }
        }

        $this->command->info('✅ Database seeded successfully with admin, formateurs, apprenants, formations, sessions, inscriptions, and paiements.');
    }
}

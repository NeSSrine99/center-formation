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
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // --------------------
        // 1️⃣ Create Roles
        // --------------------
        $adminRole = Role::firstOrCreate(
            ['name' => 'administrateur'],
            ['description' => 'Administrator with full access']
        );

        $formateurRole = Role::firstOrCreate(
            ['name' => 'formateur'],
            ['description' => 'Trainer who teaches formations']
        );

        $apprenantRole = Role::firstOrCreate(
            ['name' => 'apprenant'],
            ['description' => 'Student who takes formations']
        );

        // --------------------
        // 2️⃣ Create Admin User
        // --------------------
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password123'),
                'role_id' => $adminRole->id,
                'email_verified_at' => now(),
            ]
        );

        // --------------------
        // 3️⃣ Create Formateur Users & Profiles
        // --------------------
        $formateurUsers = [
            [
                'user_data' => ['name' => 'John Dupont', 'email' => 'john.dupont@example.com'],
                'formateur_data' => ['experience' => '10 ans', 'specialite' => 'Web Development', 'bio' => 'Expert en développement web']
            ],
            [
                'user_data' => ['name' => 'Emma Martin', 'email' => 'emma.martin@example.com'],
                'formateur_data' => ['experience' => '8 ans', 'specialite' => 'Data Science', 'bio' => 'Spécialiste en data science et machine learning']
            ],
            [
                'user_data' => ['name' => 'Pierre Bernard', 'email' => 'pierre.bernard@example.com'],
                'formateur_data' => ['experience' => '12 ans', 'specialite' => 'UI/UX Design', 'bio' => 'Designer avec expérience internationale']
            ],
        ];

        $formateurs = [];
        foreach ($formateurUsers as $fData) {
            $user = User::firstOrCreate(
                ['email' => $fData['user_data']['email']],
                [
                    'name' => $fData['user_data']['name'],
                    'password' => Hash::make('password123'),
                    'role_id' => $formateurRole->id,
                    'email_verified_at' => now(),
                ]
            );

            $formateur = Formateur::firstOrCreate(
                ['user_id' => $user->id],
                $fData['formateur_data']
            );

            $formateurs[] = $formateur;
        }

        // --------------------
        // 4️⃣ Create Apprenant Users & Profiles
        // --------------------
        $apprenants = [];
        $apprenantUsers = [
            ['name' => 'Salwa Ahmed', 'email' => 'salwa.ahmed@example.com'],
            ['name' => 'Ali Mansour', 'email' => 'ali.mansour@example.com'],
            ['name' => 'Sara Khalil', 'email' => 'sara.khalil@example.com'],
            ['name' => 'Mohamed Hassan', 'email' => 'mohamed.hassan@example.com'],
            ['name' => 'Lina Boudraa', 'email' => 'lina.boudraa@example.com'],
            ['name' => 'Fatima Zahra', 'email' => 'fatima.zahra@example.com'],
        ];

        foreach ($apprenantUsers as $aData) {
            $user = User::firstOrCreate(
                ['email' => $aData['email']],
                [
                    'name' => $aData['name'],
                    'password' => Hash::make('password123'),
                    'role_id' => $apprenantRole->id,
                    'email_verified_at' => now(),
                ]
            );

            $apprenant = Apprenant::firstOrCreate(
                ['user_id' => $user->id],
                [
                    'niveau' => ['Débutant', 'Intermédiaire', 'Avancé'][rand(0, 2)],
                    'telephone' => '06' . str_pad(rand(0, 99999999), 8, '0', STR_PAD_LEFT),
                    'statut' => 'actif'
                ]
            );

            $apprenants[] = $apprenant;
        }

        // --------------------
        // 5️⃣ Create Formations
        // --------------------
        $formations = [
            [
                'titre' => 'Développement Web Avancé',
                'description' => 'Apprenez les dernières technologies du développement web',
                'duree' => 30,
                'niveau' => 'Avancé',
                'tarif' => 450.00
            ],
            [
                'titre' => 'Introduction à la Data Science',
                'description' => 'Comprendre les bases de la science des données et du machine learning',
                'duree' => 40,
                'niveau' => 'Débutant',
                'tarif' => 550.00
            ],
            [
                'titre' => 'Design UI/UX Moderne',
                'description' => 'Créez des interfaces utilisateur magnifiques et intuitives',
                'duree' => 25,
                'niveau' => 'Intermédiaire',
                'tarif' => 350.00
            ],
            [
                'titre' => 'Python pour Débutants',
                'description' => 'Maîtrisez les fondamentaux de Python',
                'duree' => 20,
                'niveau' => 'Débutant',
                'tarif' => 300.00
            ],
            [
                'titre' => 'React.js Avancé',
                'description' => 'Devenez expert en React et les patterns modernes',
                'duree' => 35,
                'niveau' => 'Avancé',
                'tarif' => 500.00
            ],
        ];

        $createdFormations = [];
        foreach ($formations as $fData) {
            $formation = Formation::firstOrCreate(
                ['titre' => $fData['titre']],
                $fData
            );
            $createdFormations[] = $formation;
        }

        // --------------------
        // 6️⃣ Link Formateurs to Formations
        // --------------------
        foreach ($createdFormations as $index => $formation) {
            $formateur = $formateurs[$index % count($formateurs)];
            $formation->formateurs()->syncWithoutDetaching([$formateur->id]);
        }

        // --------------------
        // 7️⃣ Create Formation Sessions
        // --------------------
        $sessions = [];
        foreach ($createdFormations as $formation) {
            for ($i = 1; $i <= 2; $i++) {
                $startDate = Carbon::now()->addDays(rand(5, 30));
                $endDate = $startDate->copy()->addDays(rand(10, 20));

                $session = FormationSession::firstOrCreate(
                    [
                        'formation_id' => $formation->id,
                        'date_debut' => $startDate->format('Y-m-d'),
                        'date_fin' => $endDate->format('Y-m-d'),
                    ],
                    [
                        'lieu' => ['Salle 101', 'Salle 202', 'En ligne', 'Amphi A'][rand(0, 3)],
                        'capacite' => rand(20, 50),
                        'statut' => ['ouverte', 'fermee'][rand(0, 1)]
                    ]
                );

                $sessions[] = $session;
            }
        }

        // --------------------
        // 8️⃣ Create Inscriptions
        // --------------------
        $statusOptions = ['en_attente', 'validée', 'refusée'];

        foreach ($apprenants as $apprenant) {
            $randomSessions = collect($sessions)->random(min(3, count($sessions)));

            foreach ($randomSessions as $session) {
                $statut = $statusOptions[array_rand($statusOptions)];
                $paiement = $statut === 'validée' ? (bool) rand(0, 1) : false;

                Inscription::firstOrCreate(
                    [
                        'apprenant_id' => $apprenant->id,
                        'session_formation_id' => $session->id,
                    ],
                    [
                        'statut' => $statut,
                        'paiement' => $paiement,
                        'date_inscription' => Carbon::now()->subDays(rand(1, 15)),
                    ]
                );
            }
        }

        $paidCount = Inscription::where('paiement', true)->count();

        $this->command->info('✅ Database seeded successfully!');
        $this->command->info('📊 Created:');
        $this->command->info('  - 3 Roles (Admin, Formateur, Apprenant)');
        $this->command->info('  - 1 Admin user');
        $this->command->info('  - ' . count($formateurs) . ' Formateurs');
        $this->command->info('  - ' . count($apprenants) . ' Apprenants');
        $this->command->info('  - ' . count($createdFormations) . ' Formations');
        $this->command->info('  - ' . count($sessions) . ' Sessions de formation');
        $this->command->info('  - ' . Inscription::count() . ' Inscriptions');
        $this->command->info('  - ' . $paidCount . ' Inscriptions payées');
        $this->command->info('📊 Created:');
        $this->command->info('  - 3 Roles (Admin, Formateur, Apprenant)');
        $this->command->info('  - 1 Admin user');
        $this->command->info('  - ' . count($formateurs) . ' Formateurs');
        $this->command->info('  - ' . count($apprenants) . ' Apprenants');
        $this->command->info('  - ' . count($createdFormations) . ' Formations');
        $this->command->info('  - ' . count($sessions) . ' Sessions de formation');
        $this->command->info('  - ' . Inscription::count() . ' Inscriptions');
    }
}

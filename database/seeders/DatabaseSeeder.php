<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Atelier;
use App\Models\SecurityObject;
use App\Models\SecurityPermission;
use App\Models\SecurityRole;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        SecurityObject::create([
            'name' => 'BackEnd',
            'url' => env('APP_URL').'admin/',
            'icon' => 'admin',
            'enable' => 1,
        ]);

        SecurityObject::create([
            'name' => 'FrontEnd',
            'url' => env('APP_URL'),
            'icon' => 'front',
            'enable' => 1,
        ]);

        SecurityRole::create([
            'name' => 'SuperAdmin',
            'security_object_id' => 1,
        ]);

        SecurityRole::create([
            'name' => 'Admin',
            'security_object_id' => 1,
        ]);

        SecurityRole::create([
            'name' => 'Client',
            'security_object_id' => 2,
        ]);

        SecurityPermission::create([
            'name' => 'Users',
            'description' => "Users",
            'user_id' => 1,
        ]);

        SecurityPermission::create([
            'name' => 'Queries',
            'description' => "Registrations",
            'user_id' => 1,
        ]);

        SecurityPermission::create([
            'name' => 'Payments',
            'description' => "Payments",
            'user_id' => 1,
        ]);


        Atelier::create([
            'code' => 'a1',
            'label' => "A1 - Les trois lignes de maitrise: Quelle compréhension pour les organisations afin d'une meilleure application dans un contexte économique en constante évolution ?",
        ]);

        Atelier::create([
            'code' => 'a2',
            'label' => "A2 - Les interactions entre la conformité et l'audit interne dans le secteur bancaire",
        ]);

        Atelier::create([
            'code' => 'a3',
            'label' => "A3 - Le contrôle interne dans le secteur public: un outil indispensable pour le renforcement de l'intégrité, la transparence et la reddition des comptes",
        ]);

        Atelier::create([
            'code' => 'a4',
            'label' => "A4 - L'audit interne dans les assurances: les principaux facteurs de développement de la fonction",
        ]);

        Atelier::create([
            'code' => 'a5',
            'label' => "A5 - Le renforcement du professionalisme: un atout majeur pour le devenir de l'Auditeur interne",
        ]);

        Atelier::create([
            'code' => 'a6',
            'label' => "A6 - Les technologies innovantes: Quel challenge pour le devenir de l'Audit Interne ?",
        ]);

        Atelier::create([
            'code' => 'a7',
            'label' => "A7 - L'audit interne, le controle interne, et l'inspection: comment organiser les activités pour optimiser le travail des services d'inspection dans l'administration publique ?",
        ]);

        Atelier::create([
            'code' => 'a8',
            'label' => "A8 - Les trois délis (Fraude-corruption-blanchiement): quels dispositifs de lutte efficace pour les organisations ?",
        ]);

        Atelier::create([
            'code' => 'a9',
            'label' => "A9 - Evaluation qualité de l'audit interne: pour une amélioration continu et une crédibilté accrue",
        ]);

        Atelier::create([
            'code' => 'a10',
            'label' => "A10 - L'art de la bonne communication pour convaincre et agir",
        ]);


        Atelier::create([
            'code' => 'a11',
            'label' => "A11 - L'audit à distance: les impacts sur la réalisation des missions",
        ]);

        Atelier::create([
            'code' => 'a12',
            'label' => "A12 - La mise en oeuvre et le suivi des recommandations: quelle responsabilté pour le management et quelle responsabilité pour l'audit interne ?",
        ]);


        User::create([
            'lastname' => 'Admin',
            'firstname' => 'Super',
            'phone' => '074228306',
            'adress' => 'Montagne-Sainte',
            'email' => 'superadmin@digitech-africa.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'security_role_id' => 1,
        ]);

    }
}

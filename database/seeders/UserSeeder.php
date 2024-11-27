<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'dni' => '77298450',
            'name' => 'Esteban',
            'surnames' => 'Ramirez Quispe',
            'phone' => fake()->numerify('###') . ' ' . fake()->numerify('###') . ' ' . fake()->numerify('###'),
            'code' => '202159423',
            'status' => true,
            'email' => 'esteban@gmail.com',
            'password' => bcrypt('12345678')
        ])->assignRole('Super-admin');

        User::create([
            'dni' => '77489050',
            'name' => 'Messi',
            'surnames' => 'Suarez Apaza',
            'phone' => fake()->numerify('###') . ' ' . fake()->numerify('###') . ' ' . fake()->numerify('###'),
            'code' => '202165321',
            'status' => true,
            'email' => 'messi@gmail.com',
            'password' => bcrypt('12345678')
        ])->assignRole('Administrador');

        User::create([
            'dni' => '77298045',
            'name' => 'Maria',
            'surnames' => 'Supo Aro',
            'phone' => fake()->numerify('###') . ' ' . fake()->numerify('###') . ' ' . fake()->numerify('###'),
            'code' => '202162585',
            'status' => true,
            'email' => 'mariasupo@gmail.com',
            'password' => bcrypt('12345678')
        ])->assignRole('Secretaría');

        User::create([
            'dni' => '77489562',
            'name' => 'Angel',
            'surnames' => 'Rosendo Coaquira',
            'phone' => fake()->numerify('###') . ' ' . fake()->numerify('###') . ' ' . fake()->numerify('###'),
            'area' => 'Ingeniería de Software',
            'code' => '202165120',
            'status' => true,
            'email' => 'rosendo@gmail.com',
            'password' => bcrypt('12345678')
        ])->assignRole('Supervisor');

        User::create([
            'dni' => '77456230',
            'name' => 'Jhony',
            'surnames' => 'Coila Jarita',
            'phone' => fake()->numerify('###') . ' ' . fake()->numerify('###') . ' ' . fake()->numerify('###'),
            'code' => '202198454',
            'area' => 'Redes',
            'status' => true,
            'email' => 'jhonycoila@gmail.com',
            'password' => bcrypt('12345678')
        ])->assignRole('Supervisor');

        User::create([
            'dni' => '77306490',
            'name' => 'Esteban',
            'surnames' => 'Tocto Cano',
            'phone' => fake()->numerify('###') . ' ' . fake()->numerify('###') . ' ' . fake()->numerify('###'),
            'code' => '202120365',
            'area' => 'Gestión de TI',
            'status' => true,
            'email' => 'estebantocto@gmail.com',
            'password' => bcrypt('12345678')
        ])->assignRole('Supervisor');

        $users = User::factory(5)->create();

        foreach ($users as $user) {
            $user->assignRole('Usuario');
        }
    }
}

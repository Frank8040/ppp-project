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
            'name' => 'Xaris',
            'surnames' => 'Quispe Mamani',
            'phone' => fake()->numerify('###') . ' ' . fake()->numerify('###') . ' ' . fake()->numerify('###'),
            'code' => '202120982',
            'status' => true,
            'email' => 'xaris@gmail.com',
            'password' => bcrypt('12345678')
        ])->assignRole('Super-admin');

        $users = User::factory(5)->create();

        foreach ($users as $user) {
            $user->assignRole('Usuario');
        }
    }
}

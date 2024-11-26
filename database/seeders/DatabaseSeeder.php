<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        File::deleteDirectory('public/storage/galery');
        File::makeDirectory('public/storage/galery');

        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            YapeSeeder::class,
            CategorySeeder::class,
        ]);
    }
}

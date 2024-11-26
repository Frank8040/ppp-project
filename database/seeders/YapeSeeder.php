<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Image;
use App\Models\Yape;

class YapeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $yapes = Yape::factory(1)->create();
        foreach ($yapes as $yape) {
            Image::factory(1)->create([
                'imageable_id' => $yape->id,
                'imageable_type' => Yape::class
            ]);
        }
    }
}

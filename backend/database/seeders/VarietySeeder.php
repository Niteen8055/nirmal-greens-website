<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Src\Catalog\Infrastructure\Persistence\Eloquent\VarietyModel;

class VarietySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $varieties = [
            ['slug' => 'broccoli', 'name' => 'Broccoli', 'grow_days' => 10],
            ['slug' => 'fenugreek', 'name' => 'Fenugreek', 'grow_days' => 8],
            ['slug' => 'pink-radish', 'name' => 'Pink Radish', 'grow_days' => 9],
            ['slug' => 'mustard', 'name' => 'Mustard', 'grow_days' => 9],
            ['slug' => 'sunflower', 'name' => 'Sunflower', 'grow_days' => 12],
            ['slug' => 'radish', 'name' => 'Radish', 'grow_days' => 8],
        ];

        foreach ($varieties as $variety) {
            VarietyModel::updateOrCreate(
                ['slug' => $variety['slug']],
                $variety + ['is_active' => true],
            );
        }
    }
}

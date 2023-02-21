<?php

namespace Database\Seeders;

use App\Models\MealTime;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MealTimeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Breakfast
        DB::table('meal_times')->insert(
            [
                'name' => 'Desayuno',
            ]
        );

        // Create Lunch
        DB::table('meal_times')->insert(
            [
                'name' => 'Lunch',
            ]
        );

        // Create Snack
        DB::table('meal_times')->insert(
            [
                'name' => 'Merienda',
            ]
        );

        // Create Others
        DB::table('meal_times')->insert(
            [
                'name' => 'Otros',
            ]
        );
    }
}

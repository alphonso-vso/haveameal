<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BreakfastSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Monday
        DB::table('breakfasts')->insert(
            [
                'day' => 'Lunes',
                'meal_id' => 3,
            ]
        );

        // Create Tuesday
        DB::table('breakfasts')->insert(
            [
                'day' => 'Martes',
                'meal_id' => 4,
            ]
        );

        // Create Wednesday
        DB::table('breakfasts')->insert(
            [
                'day' => 'Miércoles',
                'meal_id' => 5,
            ]
        );

        // Create Thursdays
        DB::table('breakfasts')->insert(
            [
                'day' => 'Jueves',
                'meal_id' => 6,
            ]
        );

        // Create Friday
        DB::table('breakfasts')->insert(
            [
                'day' => 'Viernes',
                'meal_id' => 7,
            ]
        );

        // Create Saturday
        DB::table('breakfasts')->insert(
            [
                'day' => 'Sábado',
                'meal_id' => 8,
            ]
        );
    }
}

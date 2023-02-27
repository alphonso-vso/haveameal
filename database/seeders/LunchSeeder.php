<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LunchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Monday
        DB::table('lunches')->insert(
            [
                'day' => 'Lunes',
                'meal_id' => 3,
            ]
        );

        // Create Tuesday
        DB::table('lunches')->insert(
            [
                'day' => 'Martes',
                'meal_id' => 4,
            ]
        );

        // Create Wednesday
        DB::table('lunches')->insert(
            [
                'day' => 'Miércoles',
                'meal_id' => 5,
            ]
        );

        // Create Thursdays
        DB::table('lunches')->insert(
            [
                'day' => 'Jueves',
                'meal_id' => 6,
            ]
        );

        // Create Friday
        DB::table('lunches')->insert(
            [
                'day' => 'Viernes',
                'meal_id' => 7,
            ]
        );

        // Create Saturday
        DB::table('lunches')->insert(
            [
                'day' => 'Sábado',
                'meal_id' => 8,
            ]
        );
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SnackSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Monday
        DB::table('snacks')->insert(
            [
                'day' => 'Lunes',
                'meal_id' => 3,
            ]
        );

        // Create Tuesday
        DB::table('snacks')->insert(
            [
                'day' => 'Martes',
                'meal_id' => 4,
            ]
        );

        // Create Wednesday
        DB::table('snacks')->insert(
            [
                'day' => 'Miércoles',
                'meal_id' => 5,
            ]
        );

        // Create Thursdays
        DB::table('snacks')->insert(
            [
                'day' => 'Jueves',
                'meal_id' => 6,
            ]
        );

        // Create Friday
        DB::table('snacks')->insert(
            [
                'day' => 'Viernes',
                'meal_id' => 7,
            ]
        );

        // Create Saturday
        DB::table('snacks')->insert(
            [
                'day' => 'Sábado',
                'meal_id' => 8,
            ]
        );
    }
}

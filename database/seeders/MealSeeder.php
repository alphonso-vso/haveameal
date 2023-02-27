<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MealSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Meal
        DB::table('meals')->insert(
            [
                'name' => 'N/A',
                'ingredients' => '',
                'meal_time_id' => 1,
                'price' => 0
            ]
        );
        DB::table('meals')->insert(
            [
                'name' => 'Adicional',
                'ingredients' => 'Adicional',
                'meal_time_id' => 2,
                'price' => 300
            ]
        );
        DB::table('meals')->insert(
            [
                'name' => 'Prueba 2',
                'ingredients' => 'Uno, dos, tres, cuatro, cinco',
                'meal_time_id' => 3,
                'price' => 1000
            ]
        );
        DB::table('meals')->insert(
            [
                'name' => 'Prueba 3',
                'ingredients' => 'Uno, dos, tres, cuatro, cinco',
                'meal_time_id' => 3,
                'price' => 1000
            ]
        );
        DB::table('meals')->insert(
            [
                'name' => 'Prueba 4',
                'ingredients' => 'Uno, dos, tres, cuatro, cinco',
                'meal_time_id' => 4,
                'price' => 1000
            ]
        );
        DB::table('meals')->insert(
            [
                'name' => 'Prueba 5',
                'ingredients' => 'Uno, dos, tres, cuatro, cinco',
                'meal_time_id' => 3,
                'price' => 1000
            ]
        );
        DB::table('meals')->insert(
            [
                'name' => 'Prueba 6',
                'ingredients' => 'Uno, dos, tres, cuatro, cinco',
                'meal_time_id' => 5,
                'price' => 1000
            ]
        );
        DB::table('meals')->insert(
            [
                'name' => 'Prueba 7',
                'ingredients' => 'Uno, dos, tres, cuatro, cinco',
                'meal_time_id' => 4,
                'price' => 1000
            ]
        );
        DB::table('meals')->insert(
            [
                'name' => 'Prueba 8',
                'ingredients' => 'Uno, dos, tres, cuatro, cinco',
                'meal_time_id' => 5,
                'price' => 1000
            ]
        );
        DB::table('meals')->insert(
            [
                'name' => 'Prueba 9',
                'ingredients' => 'Uno, dos, tres, cuatro, cinco',
                'meal_time_id' => 3,
                'price' => 1000
            ]
        );
        DB::table('meals')->insert(
            [
                'name' => 'Prueba 10',
                'ingredients' => 'Uno, dos, tres, cuatro, cinco',
                'meal_time_id' => 3,
                'price' => 1000
            ]
        );
        DB::table('meals')->insert(
            [
                'name' => 'Prueba 11',
                'ingredients' => 'Uno, dos, tres, cuatro, cinco',
                'meal_time_id' => 3,
                'price' => 1000
            ]
        );
        DB::table('meals')->insert(
            [
                'name' => 'Prueba 12',
                'ingredients' => 'Uno, dos, tres, cuatro, cinco',
                'meal_time_id' => 5,
                'price' => 1000
            ]
        );
        DB::table('meals')->insert(
            [
                'name' => 'Prueba 13',
                'ingredients' => 'Uno, dos, tres, cuatro, cinco',
                'meal_time_id' => 6,
                'price' => 1000
            ]
        );
        DB::table('meals')->insert(
            [
                'name' => 'Prueba 14',
                'ingredients' => 'Uno, dos, tres, cuatro, cinco',
                'meal_time_id' => 6,
                'price' => 1000
            ]
        );
        DB::table('meals')->insert(
            [
                'name' => 'Prueba 15',
                'ingredients' => 'Uno, dos, tres, cuatro, cinco',
                'meal_time_id' => 4,
                'price' => 1000
            ]
        );
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OtherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Monday
        DB::table('others')->insert(
            [
                'name' => 'Prueba 1',
                'meal_id' => 3,
            ]
        );

        // Create Tuesday
        DB::table('others')->insert(
            [
                'name' => 'Prueba 2',
                'meal_id' => 4,
            ]
        );

        // Create Wednesday
        DB::table('others')->insert(
            [
                'name' => 'Prueba 3',
                'meal_id' => 5,
            ]
        );
    }
}

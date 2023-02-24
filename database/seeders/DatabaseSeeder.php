<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
use App\Models\User;
Use Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Reset cached roles and Permission
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create SA Role
        $roleSA = Role::create(['name' => 'super-admin']);

        // Create SA User
        $userSA = User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'alfonso.vargas.solis@gmail.com',
            'password' => Hash::make('OMotopixelart18+*+;'),
        ]);

        // Assign role
        $userSA->assignRole($roleSA);
        

        $this->call([
            MealTimeSeeder::class,
            MealSeeder::class,
        ]);
    }
}

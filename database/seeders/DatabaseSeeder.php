<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolesSeeder::class,
        ]);

        /*User::factory()->create([*/
        /*    'name' => 'Test User',*/
        /*    'email' => 'test@example.com',*/
        /*    'password' => bcrypt('password'),*/
        /*]);*/
        /**/
        /*User::factory()->create([*/
        /*    'name' => 'Another User',*/
        /*    'email' => 'user@example.com',*/
        /*    'password' => bcrypt('password'),*/
        /*]);*/

        $this->call([
            LocalesSeeder::class,
        ]);
    }
}

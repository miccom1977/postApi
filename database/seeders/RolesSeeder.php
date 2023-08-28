<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Tworzenie roli "user"
        Role::create([
            'name' => 'user',
        ]);

        // Tworzenie roli "editor"
        Role::create([
            'name' => 'editor',
        ]);

        // Tworzenie roli "administrator"
        Role::create([
            'name' => 'administrator',
        ]);
    }
}

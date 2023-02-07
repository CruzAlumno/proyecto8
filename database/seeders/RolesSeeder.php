<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;

// Import Models:
use App\Models\Role;

class RolesSeeder extends Seeder {
    /**
    * Run the database seeds.
    *
    * @return void
    */
    public function run() {
        // Empty Table:
        Role::truncate();
        // Fill Data:  (NOT ENDED)
        Role::create(['name' => 'Administrador']);
        Role::create(['name' => 'User']);
    }
}

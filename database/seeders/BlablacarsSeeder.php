<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
// Import Models:
use App\Models\User;
use App\Models\Customer;
use App\Models\Blablacar;

class BlablacarsSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        // Empty Table:
        Blablacar::truncate();
        // Fill Data Using Factory + Users (3 Blablacars Cada uno):
        User::factory(10)
        ->has(Customer::factory()
        ->has(Blablacar::factory()->count(3))
        ->count(2))
        ->create();
    }
}

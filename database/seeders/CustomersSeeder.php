<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;

// Import Model:
use App\Models\Customer;

class CustomersSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run() {
        // Empty Table::
        Customer::truncate();
        // Instanciacion del Model:
        $customer = new Customer();
        // Fill Data:
        $customer->user_id = '1';
        $customer->first_name = 'Denis';
        $customer->last_name = 'Catruna';
        $customer->job_title = 'Admin';
        $customer->city = 'Murcia';
        $customer->country = 'Spain';
        // Save Into DataBase:
        $customer->save();
    }
}

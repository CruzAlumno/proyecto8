<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
// Import Dependencias para la FK:
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
// Import Models:
use App\Models\User;
use App\Models\Customer;
use App\Models\Role;
use App\Models\Blablacar;
use App\Models\Vehiculo;


class DatabaseSeeder extends Seeder {
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run() {
        // Avoid FK Errors:
        Model::unguard();
        Schema::disableForeignKeyConstraints();
        // Invocar Seeds:
        self::seedAdministrador();
        self::seedCustomers();
        self::seedVehiculos();
        self::seedBlablacars();
        self::seedRoles();
        // MSG:
        $this->command->info('Tabla inicializada con datos correctamente!');
        // Reguard:
        Model::reguard();
        Schema::enableForeignKeyConstraints();

        // Util Randomizar Datos:
        // \App\Models\User::factory(10)->create();
    }
    // Seeders Para las Migraciones:
    private static function seedAdministrador() {
        // Empty Table:
        User::truncate();
        // Instanciacion del Model:
        $user_admin = new User();
        // Fill Data -- From '.env' o el Valor por Defecto especificado:
        $user_admin->name = env('ADMIN_NAME', 'admin');
        $user_admin->email = env('ADMIN_EMAIL', 'devengvengg@gmail.com');
        $user_admin->password = bcrypt(env('ADMIN_PASSWORD', 'Alumno17'));
        // Save Data Object into DB:
        $user_admin->save();
    }
    private static function seedRoles() {
        // Empty Table:
        Role::truncate();
        // Fill Data:  (Creacion Directa)
        Role::create(['name' => 'Administrador']);
        Role::create(['name' => 'User']);
    }
    private static function seedCustomers() {
        // Empty Table::
        Customer::truncate();
        // Instanciacion del Model:
        $customer = new Customer();
        // Fill Data:
        $customer->user_id = '1';
        $customer->first_name = 'Denis';
        $customer->last_name = 'Catruna';
        $customer->city = 'Murcia';
        $customer->country = 'Spain';
        $customer->telefono = '662468091';
        $customer->fecha_nacimiento = '2000-02-17';
        $customer->dni = 'XXXXXXXXX';
        // Save Into DataBase:
        $customer->save();
    }
    private static function seedVehiculos() {
        // Empty Table:
        Vehiculo::truncate();
        // Instanciacion del Model:
        $vehiculo = new Vehiculo();
        // Fill Data:
        $vehiculo->customer_id = '1';
        $vehiculo->combustible = 'gasolina';
        $vehiculo->fecha_matriculacion = '2007';
        $vehiculo->modelo = 'Volkswagen Golf 6';
        $vehiculo->potencia_cv = 140;
        $vehiculo->plazas = 5;
        $vehiculo->puertas = 5;
        $vehiculo->consumo_medio = 7.2;
        $vehiculo->matricula = '0000XXX';
        // Save Into DataBase:
        $vehiculo->save();
    }
    private static function seedBlablacars() {
        // Empty Table:
        Blablacar::truncate();
        // Instanciacion del Model:
        $blablacar = new Blablacar();
        // FIll Data:
        $blablacar->customer_id = '1';
        $blablacar->vehiculo_id = '1';
        $blablacar->titulo = 'Viaje a Valencia';
        $blablacar->descripcion = 'Se Ruega Ser Puntuales!';
        $blablacar->fecha_inicio_viaje = '2023-02-18';
        $blablacar->hora_inicio_viaje = '07:00:00';
        $blablacar->inicio_ruta = 'Balsapintada, Murcia';
        $blablacar->destino_ruta = 'Valencia Centro';
        $blablacar->distancia = 254;
        $blablacar->estimacion_duracion = '02:34:00';
        $blablacar->precio_combustible = 1.6;
        // Datos Calculados:
        $car = Vehiculo::findOrFail($blablacar->vehiculo_id);
        $blablacar->plazas_disponibles = $car->plazas - 2;
        $blablacar->precio = (($car->consumo_medio * $blablacar->distancia / 100) * $blablacar->precio_combustible) / ($car->plazas - $blablacar->plazas_disponibles);
        // Save Into DataBase:
        $blablacar->save();
    }
}

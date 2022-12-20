<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
// Import Dependencias para la FK:
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;
// Import Models:
use App\Models\User;
use App\Models\Usuario_perfile;
use App\Models\Vehiculo;
use App\Models\Producto;

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
        self::seedUsuarios_perfiles();
        self::seedVehiculos();
        self::seedProductos();
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
    private static function seedUsuarios_perfiles() {
        // Limpieza de Tabla por si hubiera algo:
        Usuario_perfile::truncate();
        // Datos Array:
    }
    private static function seedVehiculos() {
        // Limpieza de Tabla por si hubiera algo:
        Vehiculo::truncate();
        // Datos Array:
    }
    private static function seedProductos() {
        // Limpieza de Tabla por si hubiera algo:
        Producto::truncate();
        // Datos Array:
        foreach(self::$array_productos as $producto) {
            // Instanciar Modelo ORM controlador:
            $modelo = new Producto();
            // Rellenar con Data del Array:
            $modelo->titulo = $producto['titulo'];
            $modelo->descripcion = $producto['descripcion'];
            $modelo->fecha_inicio_viaje = $producto['fecha_viaje'];
            $modelo->hora_inicio_viaje = $producto['hora_viaje'];
            $modelo->inicio_ruta = $producto['inicio_ruta'];
            $modelo->destino_ruta = $producto['destino_ruta'];
            $modelo->distancia = $producto['distancia'];
            $modelo->precio = $producto['precio'];
            $modelo->status_active = $producto['status_active'];
            $modelo->allow_desvios = $producto['allow_desvios'];
            $modelo->estimacion_llegada = $producto['estimacion_hora_llegada'];
            // Sin el Save No hacemos Nada en la DB:
            $modelo->save();
        }
    }
    // -------------------------- Default Test Data:
    private static $array_productos = [
        // Key, en el ForEach sera = 0, 1, 2 .. Posicion de Arrays Dentro del Array
        [
            'postID' => 0,
            'userID' => 'denis17',
            'titulo' => 'Viaje a Madrid',
            'descripcion' => 'Ser Puntuales!',
            'fecha_viaje' => '2022-12-17',
            'hora_viaje' => '23:36:56',
            'inicio_ruta' => 'Carlos III, Cartagena',
            'destino_ruta' => 'Madrid, Warner Bross',
            'plazas' => 3,
            'precio' => 0.00,
            'status_active' => false,
            'allow_desvios' => false,
            'estimacion_hora_llegada' => '2022-12-18 22:36:56.000000',
            'distancia' => 0.00,
            'email' => 'devengvengg@gmail.com',
            'tfn' => '662 468 091'
        ]
    ];
}

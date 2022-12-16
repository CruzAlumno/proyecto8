<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
// Model Import:
use App\Models\Producto;

class ProductosController extends Controller {
    // Obtener Index:
    public function getIndex() {
        // Select All With The model:
        $productos = Producto::all();
        return view('productos.index', ['array_productos' => $productos]);
    }
    // Obtener Create:
    public function getCreate() {
        return view('productos.create');
    }
    // Obtener Show ID:
    public function getShow($id) {
        $producto = Producto::findOrFail($id);
        return view('productos.show', [ 'producto' => $producto ]);
    }
    // Obtener Edit ID:
    public function getEdit($id) {
        $producto = Producto::findOrFail($id);
        return view('productos.edit', [ 'producto' => $producto ]);
    }
    // ------------------------- Almacenamiento de Datos Temporal (Variable Encapsulada) --- Trasladado a la DB con Migraciones y Seeder.
    // private $array_productos = [
    //     // Key, en el ForEach sera = 0, 1, 2 .. Posicion de Arrays Dentro del Array
    //     [
    //         'postID' => 0,
    //         'userID' => 'denis17',
    //         'titulo' => 'Viaje a Madrid',
    //         'descripcion' => 'Ser Puntuales!',
    //         'fecha_viaje' => '17/12/2022',
    //         'hora_viaje' => '12:00',
    //         'inicio_ruta' => 'Carlos III, Cartagena',
    //         'destino_ruta' => 'Madrid, Warner Bross',
    //         'plazas' => '3',
    //         'precio' => 'AUTOCALCULADO_funcion_plazas_vehiculo_distancia',
    //         'status_active' => 'true',
    //         'allow_desvios' => 'false',
    //         'estimacion_hora_llegada' => 'AUTOCALCULADO',
    //         'distancia' => 'AUTOCALCULADO',
    //         'email' => 'devengvengg@gmail.com',
    //         'tfn' => '662 468 091'
    //     ]
    // ];
}

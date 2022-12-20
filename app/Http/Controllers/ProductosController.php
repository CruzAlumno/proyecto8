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
    public function postStore(Request $request) {
        // Instanciacion del Model:
        $producto_model = new Producto();
        // Almacenar Datos Recogidos del Formulario:
        $producto_model->titulo = $request->input('titulo');
        $producto_model->fecha_inicio_viaje = $request->input('fecha-viaje');
        $producto_model->hora_inicio_viaje = $request->input('hora-viaje');
        $producto_model->descripcion = $request->input('descripcion');
        $producto_model->inicio_ruta = $request->input('inicio-ruta');
        $producto_model->destino_ruta = $request->input('destino-ruta');
        //$producto_model->plazas_disponibles = $request->input('plazas'); Update -- "Trigger"
        $producto_model->allow_desvios = $request->input('allow-desvios');
        // Guardar cambios del Objecto en la DB:
        $producto_model->save();
        // Redireccion Al Nuevo Elemento:
        $url = action([ProductosController::class, 'getShow'], ['id' => $producto_model->id]);
        return redirect($url);
    }
    public function postEdit(Request $request, $id) {
        // Modificar Producto Concreto:
        $producto_model = Producto::findOrFail($id);
        // Almacenar Datos Recogidos del Formulario:
        $producto_model->titulo = $request->input('titulo');
        $producto_model->fecha_inicio_viaje = $request->input('fecha-viaje');
        $producto_model->hora_inicio_viaje = $request->input('hora-viaje');
        $producto_model->descripcion = $request->input('descripcion');
        $producto_model->inicio_ruta = $request->input('inicio-ruta');
        $producto_model->destino_ruta = $request->input('destino-ruta');
        //$producto_model->plazas_disponibles = $request->input('plazas');
        $producto_model->allow_desvios = $request->input('allow-desvios');
        $producto_model->status_active = $request->input('status-post');
        // Guardar cambios del Objecto en la DB:
        $producto_model->save();
        // Redireccion Al Nuevo Elemento Modificado:
        $url = action([ProductosController::class, 'getShow'], ['id' => $producto_model->id]);
        return redirect($url);
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

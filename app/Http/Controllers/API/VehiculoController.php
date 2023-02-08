<?php

namespace App\Http\Controllers\API;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Vehiculo;
// Import Resource:
use App\Http\Resources\VehiculoResource;

class VehiculoController extends Controller {
    /**
     * Create the controller instance. For Policies Autorization
     *
     * @return void
     */
    public function __construct() {
        $this->authorizeResource(Vehiculo::class, 'vehiculo');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
        // Paginacion Controlada por Middleware:
        $num_elementos = $request->input('numElements');
        // SEARCH BAR:  (La 'q' es porque lo inidicamos asi en el Cliente) + Helper
        $busqueda_keys = ['customer_id', 'combustible', 'fecha_matriculacion', 'modelo', 'potencia_cv', 'plazas', 'puertas', 'consumo_medio', 'matricula'];
        $registros = searchByField($busqueda_keys, Vehiculo::class);
        return VehiculoResource::collection($registros->paginate($num_elementos));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $vehiculo = json_decode($request->getContent(), true);
        $vehiculo = Vehiculo::create($vehiculo['data']['attributes']);
        return new VehiculoResource($vehiculo);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vehiculo  $vehiculo
     * @return \Illuminate\Http\Response
     */
    public function show(Vehiculo $vehiculo) {
        return new VehiculoResource($vehiculo);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vehiculo  $vehiculo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vehiculo $vehiculo) {
        $vehiculo_data = json_decode($request->getContent(), true);
        $vehiculo->update($vehiculo_data['data']['attributes']);
        return new VehiculoResource($vehiculo);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vehiculo  $vehiculo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vehiculo $vehiculo) {
        $vehiculo->delete();
    }
}

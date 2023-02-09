<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use App\Models\Blablacar;
use Illuminate\Http\Request;
// Imports Dependencies:
use App\Http\Resources\BlablacarResource;
use Illuminate\Support\Facades\Gate;

class BlablacarController extends Controller {
    												//Create the controller instance. For Policies Autorization
    public function __construct() {
        $this->authorizeResource(Blablacar::class, 'blablacar');
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
        $busqueda_keys = ['customer_id', 'titulo', 'fecha_inicio_viaje', 'inicio_ruta', 'destino_ruta'];
        $registros = searchByField($busqueda_keys, Blablacar::class);
        return BlablacarResource::collection($registros->paginate($num_elementos));

        // Mostrar Solo Sus Blablacars:
        // $user = $request->user();
        // $registros = ($user->isAdmin())
        //     ? Blablacar::all()
        //     : $user->customer->blablacars;
        // return BlablacarResource::collection($registros);
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $blablacar = json_decode($request->getContent(), true);
        $blablacar = Blablacar::create($blablacar['data']['attributes']);
        return new BlablacarResource($blablacar);
    }
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blablacar  $blablacar
     * @return \Illuminate\Http\Response
     */
    public function show(Blablacar $blablacar) {
        return new BlablacarResource($blablacar);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blablacar  $blablacar
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Blablacar $blablacar) {
        $blablacar_data = json_decode($request->getContent(), true);
        $blablacar->update($blablacar_data['data']['attributes']);
        return new BlablacarResource($blablacar);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blablacar  $blablacar
     * @return \Illuminate\Http\Response
     */
    public function destroy(Blablacar $blablacar) {
        $blablacar->delete();
    }
}

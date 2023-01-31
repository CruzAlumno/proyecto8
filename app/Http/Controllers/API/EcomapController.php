<?php

namespace App\Http\Controllers\API;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// Imports Necesarios:
use Illuminate\Support\Facades\Http;
use App\Http\Resources\EcomapResource;

class EcomapController extends Controller {
    public function index(Request $request) {
        // Search Bar:
        //$search = 'Murcia';
        $search = $request->input('filter')
            ? $request->input('filter')['q']
            : 'Murcia';
        $limit = 5;
        // La key la cogeremos de las variables de entorno
        $key = env("API_KEY");
        // URL CONSULTA:
        $urlAPI = "https://geocode.search.hereapi.com/v1/geocode?";
        $queryString = "q=$search&limit=$limit&apiKey=$key";
        $urlConsulta = $urlAPI . $queryString;
        // Consultamos a la API
        $response = Http::get($urlConsulta);
        return EcomapResource::collection($response->collect()->toArray()['items']);
    }
}

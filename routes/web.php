<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Imports:
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductosController;
use Illuminate\Support\Facades\Auth;

// ------------------------------------- @ My Routes:

Route::get('/home', [HomeController::class, 'getHome']);
Route::prefix('productos')->group(function() {
    // Se Acceden con el Prefijo  '/productos/...'
    Route::get('/', [ProductosController::class, 'getIndex']);
    // Requiere Estar Autenticado Para Consultar:
    Route::group(['middleware' => 'auth'], function () {
        Route::get('/create', [ProductosController::class, 'getCreate']);
        Route::get('/show/{id}', [ProductosController::class, 'getShow']);
        Route::get('/edit/{id}', [ProductosController::class, 'getEdit']);
        // Data Store:
        Route::post('/create', [ProductosController::class, 'postStore']);
        Route::put('/edit/{id}', [ProductosController::class, 'postEdit']);
    });
});

// -------------------- API Dependencies:
Route::get('/', function () {
    return ['Laravel' => app()->version()];
});
require __DIR__.'/auth.php';

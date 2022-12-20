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

// ------------------------------------- @ My Routes:

Route::get('/', [HomeController::class, 'getHome']);
Route::prefix('productos')->group(function() {
    // Se Acceden con el Prefijo  '/productos/...'
    Route::get('/', [ProductosController::class, 'getIndex']);
    // Requiere Estar Autenticado Para Consultar:
    Route::get('/create', [ProductosController::class, 'getCreate'])->middleware(['auth'])->name('dashboard');
    Route::get('/show/{id}', [ProductosController::class, 'getShow'])->middleware(['auth'])->name('dashboard');
    Route::get('/edit/{id}', [ProductosController::class, 'getEdit'])->middleware(['auth'])->name('dashboard');
    // Data Store:
    Route::post('/create', [ProductosController::class, 'postStore'])->middleware(['auth'])->name('dashboard');
    Route::put('/edit/{id}', [ProductosController::class, 'postEdit'])->middleware(['auth'])->name('dashboard');
});

// ------------------------- Breeze Auth Dependencies:

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');
require __DIR__.'/auth.php';

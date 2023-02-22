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
// Mail Sending:
use App\Http\Controllers\Mail\MailController;

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
// -------------------- Mail Test Server: http://proyecto8.test/send/X
Route::get('/send/notificacion', [MailController::class, 'sendNotification']);
Route::get('/send/notificacion/to/{email}/{subject}', [MailController::class, 'sendNotificationTo']);
Route::get('/send/message/{email}/{subject}/{data}', [MailController::class, 'sendMailTo']);
// -------------------- TEST STRIPE PAYMENT: http://proyecto8.test/payments
Route::get('/payments', 'App\Http\Controllers\StripeController@index')->name('index');
Route::post('/payments/checkout', 'App\Http\Controllers\StripeController@checkout')->name('checkout');
Route::get('/payments/success', 'App\Http\Controllers\StripeController@success')->name('success');
// -------------------- Cashier Test: http://proyecto8.test/cashier
Route::get('/cashier', 'App\Http\Controllers\CashierController@index')->name('index');
Route::post('single-charge', 'App\Http\Controllers\CashierController@singleCharge')->name('single.charge');
// -------------------- API Dependencies:
Route::get('/', function () {
    return ['Laravel' => app()->version()];
});
require __DIR__.'/auth.php';

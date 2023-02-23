<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// PHP CRUD API Dependencies:
use Psr\Http\Message\ServerRequestInterface;
use Tqdev\PhpCrudApi\Api;
use Tqdev\PhpCrudApi\Config\Config;
// Import API Controllers:
use App\Http\Controllers\API\CustomerController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\EcomapController;
use App\Http\Controllers\API\TokenController;
use App\Http\Controllers\API\VehiculoController;
use App\Http\Controllers\API\BlablacarController;
use App\Http\Controllers\API\AvatarController;
// Mails Controller:
use App\Http\Controllers\Mail\MailController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
// --------------------- API Dependencies + Autorization Gates / Policies:
Route::apiResource('users', UserController::class);
Route::apiResource('customers', CustomerController::class)->middleware('auth:sanctum');
Route::apiResource('vehiculos', VehiculoController::class)->middleware('auth:sanctum');
Route::apiResource('blablacars', BlablacarController::class)->middleware('auth:sanctum');
// --------------------- Avatar Controller: api/avatars
Route::post('/avatars', [AvatarController::class, 'store'])->middleware('auth:sanctum');
Route::get('/avatars', [AvatarController::class, 'getAvatar'])->middleware('auth:sanctum');
Route::get('/avatars/{user_id}', [AvatarController::class, 'getUserAvatar']);
// --------------------- API Externa Here Maps:
Route::get('ecomaps', [EcomapController::class, 'index']);
// --------------------- Sending Mails: ToDo Usar la Auth de la DB.
Route::get('/send/notificacion', [MailController::class, 'sendNotification'])->middleware('auth:sanctum');
Route::post('/send/notificacion/to/{email}/{subject}', [MailController::class, 'sendNotificationTo'])->middleware('auth:sanctum');
Route::post('/send/message/{email}/{subject}/{data}', [MailController::class, 'sendMailTo'])->middleware('auth:sanctum');
// ---------------------- Stripe Payment: Test in Web, To Do Comunicarlo con React.
Route::get('/payments', 'App\Http\Controllers\StripeController@index')->name('index')->middleware('auth:sanctum');
Route::post('/payments/checkout', 'App\Http\Controllers\StripeController@checkout')->name('checkout')->middleware('auth:sanctum');
Route::get('/payments/success', 'App\Http\Controllers\StripeController@success')->name('success')->middleware('auth:sanctum');
// --------------------- Cashier: Test in Web, To Do Comunicarlo con React.
Route::get('/cashier', 'App\Http\Controllers\CashierController@index')->name('index')->middleware('auth:sanctum');
Route::post('single-charge', 'App\Http\Controllers\CashierController@singleCharge')->name('single.charge')->middleware('auth:sanctum');
// --------------------- Auth Token Dependencies:
// emite un nuevo token
Route::post('tokens', [TokenController::class, 'store']);
// elimina el token del usuario autenticado
Route::delete('tokens', [TokenController::class, 'destroy'])->middleware('auth:sanctum');
// Proteccion Rutas:
Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    $user = $request->user();
    $user->fullName = $user->name;
    return $user;
});
// --------------------- PHP CRUD API Dependencies:
Route::any('/{any}', function (ServerRequestInterface $request) {
    $config = new Config([
        'address' => env('DB_HOST', '127.0.0.1'),
        'database' => env('DB_DATABASE', 'forge'),
        'username' => env('DB_USERNAME', 'forge'),
        'password' => env('DB_PASSWORD', ''),
        'basePath' => '/api',
    ]);
    $api = new Api($config);
    $response = $api->handle($request);

    // Rested:
    //return $response;

    // React:
    //$records = json_decode($response->getBody()->getContents())->records;
    //return response()->json($records, 200, $headers = ['X-Total-Count' => count($records)]);

    // React Con Edit y Add:
    try {
        $records = json_decode($response->getBody()->getContents())->records;
        $response = response()->json($records, 200, $headers = ['X-Total-Count' => count($records)]);
    } catch (\Throwable $th) {}
    return $response;
})->where('any', '.*');

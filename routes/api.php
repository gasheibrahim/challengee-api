<?php
// use App\Models\Sector;
use App\Http\Controllers\SectorController;
use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

//Route::resource('sectors', SectorController::class);

//public Routes
Route::post('/register', [AuthController::class, 'register']);
// Route::post('/login', [AuthController::class, 'login']);
Route::get('/sectors', [SectorController::class, 'index']);
Route::get('/sectors/{id}', [SectorController::class, 'show']);
Route::get('/sectors/search/{name}', [SectorController::class, 'search']);
Route::post('/sectors', [SectorController::class, 'store']);
Route::put('/sectors/{id}', [SectorController::class, 'update']);
Route::delete('/sectors/{id}', [SectorController::class, 'destroy']);
Route::post('/logout', [AuthController::class, 'logout']);

// Route::get('/sectors', [SectorController::class, 'index']);
// Route::post('/sectors', [SectorController::class, 'store']);

//protected Routes
Route::group(['middleware' => ['auth:sanctum']], function () {
    // Route::post('/sectors', [SectorController::class, 'store']);
    // Route::put('/sectors/{id}', [SectorController::class, 'update']);
    // Route::delete('/sectors/{id}', [SectorController::class, 'destroy']);
    // Route::post('/logout', [AuthController::class, 'logout']);
});


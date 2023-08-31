<?php
 
use App\Http\Controllers\Api\PropertiController;
use App\Http\Controllers\Api\UserController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/login', [UserController::class, 'login']);

Route::post('/register', [UserController::class, 'register']); 

Route::get('/properti', [PropertiController::class, 'index']);

Route::get('/getPropertiById/{id}', [PropertiController::class, 'getProperti']);

Route::post('/properti/upload/{id}', [PropertiController::class, 'upload']);

Route::post('/properti/delete/{id}/{user_id}', [PropertiController::class, 'delete']);

Route::post('/properti/lokasi', [PropertiController::class, 'uploadLokasi']);

Route::post('/properti/data', [PropertiController::class, 'uploadData']);

Route::post('/delete/{id}/{user_id}', [PropertiController::class, 'deleteProperti']);
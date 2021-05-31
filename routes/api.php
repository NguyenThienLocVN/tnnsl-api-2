<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\GPNuocMatController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::group(['prefix' => 'quan-ly-cap-phep/nuoc-mat'], function()
{
    Route::get('danh-sach-giay-phep', [GPNuocMatController::class, 'listHydroelectricLicense']);

    Route::get('hang-muc-cong-trinh/{id_gp}', [GPNuocMatController::class, 'constructionItems']);

    Route::get('luu-luong-theo-muc-dich-sd/{id_gp}', [GPNuocMatController::class, 'TrafficAccordingToThePurposeOfUse']);
});
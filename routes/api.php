<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\QuanLyCapPhepController;
use App\Http\Controllers\api\GPNuocMatController;
use App\Http\Controllers\api\GPKTSDNuocDuoiDatController;
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
    
Route::group(['prefix' => 'quan-ly-cap-phep/'], function()
{
    Route::get('dem-giay-phep', [QuanLyCapPhepController::class, 'countLicense']);
    Route::get('dem-giay-phep-theo-nam', [QuanLyCapPhepController::class, 'countLicenseFolowYear']);
});

Route::group(['prefix' => 'quan-ly-cap-phep/nuoc-mat'], function()
{
    Route::get('danh-sach-tat-ca-giay-phep', [GPNuocMatController::class, 'allFaceWaterLicenses']);
    Route::get('dem-so-giay-phep', [GPNuocMatController::class, 'countLicenceNumber']);

	Route::get('giay-phep-thuy-dien/{id_gp}', [GPNuocMatController::class, 'hydroelectricLicenseInfo']);

    Route::get('luu-luong-theo-muc-dich-sd/{id_gp}', [GPNuocMatController::class, 'TrafficAccordingToThePurposeOfUse']);

    Route::get('tai-lieu/{id_gp}', [GPNuocMatController::class, 'tai_lieu']);

    Route::get('chat-luong-nuoc-mat-qcvn', [GPNuocMatController::class, 'chat_luong_nuoc_mat_qcvn']);
});

Route::group(['prefix' => 'quan-ly-cap-phep/nuoc-duoi-dat'], function()
{
    Route::get('danh-sach-giay-phep', [GPKTSDNuocDuoiDatController::class, 'license']);
    Route::get('giay-phep-khai-thac/{id_gp}', [GPKTSDNuocDuoiDatController::class, 'singleLicense']);
    Route::get('dem-giay-phep', [GPKTSDNuocDuoiDatController::class, 'countLicense']);
});
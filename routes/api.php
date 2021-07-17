<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\QuanLyCapPhepController;
use App\Http\Controllers\api\GPNuocMatController;
use App\Http\Controllers\api\GPKTNuocDuoiDatController;
use App\Http\Controllers\api\GPTDNuocDuoiDatController;
use App\Http\Controllers\api\GPKhoanNuocDuoiDatController;
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
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

// Quan ly cap phep
Route::group(['prefix' => 'quan-ly-cap-phep/'], function()
{
    Route::get('dem-giay-phep', [QuanLyCapPhepController::class, 'countLicense']);
    Route::get('dem-giay-phep-theo-loai', [QuanLyCapPhepController::class, 'countLicenseFolowType']);
});

// Quan ly cap phep - Nuoc mat
Route::group(['prefix' => 'quan-ly-cap-phep/nuoc-mat/'], function()
{
    Route::get('danh-sach-tat-ca-giay-phep', [GPNuocMatController::class, 'allFaceWaterLicenses']);
    Route::get('dem-giay-phep', [GPNuocMatController::class, 'countLicenceNumber']);
	Route::get('giay-phep-thuy-dien/{id_gp}', [GPNuocMatController::class, 'hydroelectricLicenseInfo']);
    Route::get('luu-luong-theo-muc-dich-sd/{id_gp}', [GPNuocMatController::class, 'TrafficAccordingToThePurposeOfUse']);
    Route::get('tai-lieu/{id_gp}', [GPNuocMatController::class, 'tai_lieu']);
    Route::get('chat-luong-nuoc-mat-qcvn', [GPNuocMatController::class, 'chat_luong_nuoc_mat_qcvn']);
    Route::get('{loaiCongTrinh}/loc-giay-phep/{status}', [GPNuocMatController::class, 'filterHydroelectricLicense']);
    Route::get('{loaiCongTrinh}/thong-tin-ban-do-cong-trinh', [GPNuocMatController::class, 'hydroelectricContructionInfoForMap']);
});

// Quan ly cap phep - Nuoc duoi dat
Route::group(['prefix' => 'quan-ly-cap-phep/nuoc-duoi-dat/khai-thac/'], function()
{
    Route::post('cap-moi-giay-phep', [GPKTNuocDuoiDatController::class, 'createLicense']);
    Route::get('xoa-giay-phep/{id_gp}', [GPKTNuocDuoiDatController::class, 'destroyStatus']);
    Route::get('giay-phep-khai-thac/{id_gp}', [GPKTNuocDuoiDatController::class, 'singleLicense']);
    Route::get('dem-giay-phep', [GPKTNuocDuoiDatController::class, 'countLicense']);
    Route::get('loc-giay-phep/{status}', [GPKTNuocDuoiDatController::class, 'filterLicense']);
    Route::get('danh-sach-cap-moi-giay-phep-ktndd/{user_id}/{status}', [GPKTNuocDuoiDatController::class, 'NewLicenseManagement']);
    Route::get('thong-tin-ban-do-cong-trinh', [GPKTNuocDuoiDatController::class, 'contructionInfoForMap']);
});

// Quan ly cap phep - Nuoc duoi dat - Tham do
Route::group(['prefix' => 'quan-ly-cap-phep/nuoc-duoi-dat/tham-do/'], function()
{
    Route::get('dem-giay-phep', [GPTDNuocDuoiDatController::class, 'countLicense']);
    Route::get('giay-phep-tham-do/{id_gp}', [GPTDNuocDuoiDatController::class, 'singleLicense']);
    Route::get('loc-giay-phep/{status}', [GPTDNuocDuoiDatController::class, 'filterLicense']);
    Route::get('xoa-giay-phep/{id_gp}', [GPTDNuocDuoiDatController::class, 'destroyStatus']);
    Route::get('danh-sach-cap-moi-giay-phep-ktndd/{user_id}/{status}', [GPTDNuocDuoiDatController::class, 'NewLicenseManagement']);
});

// Quan ly cap phep - Nuoc duoi dat - Khoan
Route::group(['prefix' => 'quan-ly-cap-phep/nuoc-duoi-dat/khoan/'], function()
{
    Route::get('dem-giay-phep', [GPKhoanNuocDuoiDatController::class, 'countLicense']);
    Route::get('giay-phep-tham-do/{id_gp}', [GPKhoanNuocDuoiDatController::class, 'singleLicense']);
    Route::get('loc-giay-phep/{status}', [GPKhoanNuocDuoiDatController::class, 'filterLicense']);
    Route::get('xoa-giay-phep/{id_gp}', [GPKhoanNuocDuoiDatController::class, 'destroyStatus']);
    Route::get('danh-sach-cap-moi-giay-phep-ktndd/{user_id}/{status}', [GPKhoanNuocDuoiDatController::class, 'NewLicenseManagement']);
});
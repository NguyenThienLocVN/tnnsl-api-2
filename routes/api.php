<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\QuanLyCapPhep\QuanLyCapPhepController;
use App\Http\Controllers\api\QuanLyCapPhep\NuocMat\GPNuocMatController;
use App\Http\Controllers\api\QuanLyCapPhep\NuocDuoiDat\GPKTNuocDuoiDatController;
use App\Http\Controllers\api\QuanLyCapPhep\NuocDuoiDat\GPTDNuocDuoiDatController;
use App\Http\Controllers\api\QuanLyCapPhep\NuocDuoiDat\GPKhoanNuocDuoiDatController;

use App\Http\Controllers\api\HeThongQuanTrac\HeThongQuanTracController;
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

// QUAN LY CAP PHEP
Route::group(['prefix' => 'quan-ly-cap-phep/'], function()
{
    Route::get('dem-giay-phep', [QuanLyCapPhepController::class, 'countLicense']);
    Route::get('dem-giay-phep-theo-loai/{startYear}/{endYear}', [QuanLyCapPhepController::class, 'countLicenseFolowType']);

    // QUAN LY CAP PHEP - NUOC MAT
    Route::group(['prefix' => 'nuoc-mat/'], function()
    {
        // DEM GIAY PHEP
        Route::get('dem-giay-phep', [GPNuocMatController::class, 'countLicenceNumber']);


        // THONG TIN GIAY PHEP
        Route::get('{loaiCongTrinh}/thong-tin-giay-phep/{id_gp}', [GPNuocMatController::class, 'hydroelectricLicenseInfo']);


        // LOC GIAY PHEP THEP HIEU LUC VA HIEN THI
        Route::get('{loaiCongTrinh}/loc-giay-phep/{status}', [GPNuocMatController::class, 'filterHydroelectricLicense']);


        // THONG TIN CONG TRINH TREN BAN DO
        Route::get('{loaiCongTrinh}/thong-tin-ban-do-cong-trinh', [GPNuocMatController::class, 'hydroelectricContructionInfoForMap']);


         // CAP MOI GIAY PHEP
        Route::post('cap-moi-giay-phep', [GPNuocMatController::class, 'createLicense']);


        // SUA GIAY PHEP
        Route::post('sua-giay-phep/{id_gp}', [GPNuocMatController::class, 'editLicense']);


        // XOA GIAY PHEP
        Route::get('xoa-giay-phep/{id_gp}', [GPNuocMatController::class, 'destroyStatus']);


        // DANH SACH GIAY PHEP DA CAP THEO TAI KHOAN
        Route::get('{loaiCongTrinh}/ho-so-da-cap/{user_id}/', [GPNuocMatController::class, 'grantedLicenseByUser']);

        // DANH SACH GIAY PHEP CAP MOI THEO TAI KHOAN
        Route::get('{loaiCongTrinh}/ho-so-cap-moi/{user_id}/', [GPNuocMatController::class, 'newLicenseByUser']);

        // DANH SACH GIAY PHEP CAP MOI THEO TAI KHOAN
        Route::get('{loaiCongTrinh}/ho-so-gia-han/{user_id}/', [GPNuocMatController::class, 'extendLicenseByUser']);

        // DANH SACH GIAY PHEP CAP MOI THEO TAI KHOAN
        Route::get('{loaiCongTrinh}/ho-so-thu-hoi/{user_id}/', [GPNuocMatController::class, 'recallLicenseByUser']);

    });
    // QUAN LY CAP PHEP - NUOC DUOI DAT
    Route::group(['prefix' => 'nuoc-duoi-dat/'], function(){
        //KHAI THAC
        Route::group(['prefix' => 'khai-thac/'], function()
        {
            // CAP MOI GIAY PHEP
            Route::post('cap-moi-giay-phep', [GPKTNuocDuoiDatController::class, 'createLicense']);


            // XOA GIAY PHEP
            Route::get('xoa-giay-phep/{id_gp}', [GPKTNuocDuoiDatController::class, 'destroyStatus']);


            // THONG TIN GIAY PHEP
            Route::get('giay-phep-khai-thac/{id_gp}', [GPKTNuocDuoiDatController::class, 'singleLicense']);


             // DEM GIAY PHEP
            Route::get('dem-giay-phep', [GPKTNuocDuoiDatController::class, 'countLicense']);


            // LOC GIAY PHEP THEP HIEU LUC VA HIEN THI
            Route::get('loc-giay-phep/{status}', [GPKTNuocDuoiDatController::class, 'filterLicense']);

            // QUAN LY YEU CAU CAP MOI GIAY PHEP
            Route::get('danh-sach-cap-moi-giay-phep-ktndd/{user_id}/{status}', [GPKTNuocDuoiDatController::class, 'NewLicenseManagement']);


            // THONG TIN CONG TRINH TREN BAN DO
            Route::get('thong-tin-ban-do-cong-trinh', [GPKTNuocDuoiDatController::class, 'contructionInfoForMap']);
        });
        // THAM DO
        Route::group(['prefix' => 'tham-do/'], function()
        {
            Route::get('dem-giay-phep', [GPTDNuocDuoiDatController::class, 'countLicense']);
            Route::get('giay-phep-tham-do/{id_gp}', [GPTDNuocDuoiDatController::class, 'singleLicense']);
            Route::get('loc-giay-phep/{status}', [GPTDNuocDuoiDatController::class, 'filterLicense']);
            Route::get('xoa-giay-phep/{id_gp}', [GPTDNuocDuoiDatController::class, 'destroyStatus']);
            Route::get('danh-sach-cap-moi-giay-phep-ktndd/{user_id}/{status}', [GPTDNuocDuoiDatController::class, 'NewLicenseManagement']);
        });

        // HANH NGHE KHOAN
        Route::group(['prefix' => 'khoan/'], function()
        {
            Route::get('dem-giay-phep', [GPKhoanNuocDuoiDatController::class, 'countLicense']);
            Route::get('giay-phep-tham-do/{id_gp}', [GPKhoanNuocDuoiDatController::class, 'singleLicense']);
            Route::get('loc-giay-phep/{status}', [GPKhoanNuocDuoiDatController::class, 'filterLicense']);
            Route::get('xoa-giay-phep/{id_gp}', [GPKhoanNuocDuoiDatController::class, 'destroyStatus']);
            Route::get('danh-sach-cap-moi-giay-phep-ktndd/{user_id}/{status}', [GPKhoanNuocDuoiDatController::class, 'NewLicenseManagement']);
        });
    });
});






// HE THONG QUAN TRAC
Route::group(['prefix' => 'he-thong-quan-trac/'], function()
{
    Route::get('loc-dia-diem/{locationType}', [HeThongQuanTracController::class, 'filterLocation']);
});
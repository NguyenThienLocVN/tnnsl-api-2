<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GPNuocMat;
use App\Models\GPKTNuocDuoiDat;
use App\Models\GPTDNuocDuoiDat;
use App\Models\GPKhoanNuocDuoiDat;
use Carbon\Carbon;

class QuanLyCapPhepController extends Controller
{
    public function countLicense()
    {
        $currentDate = Carbon::now();

        // gp_ktnuocduoidat
        $allgp_ktnuocduoidat = GPKTNuocDuoiDat::all()->count();
        $gp_ktnuocduoidatGPDaCap = GPKTNuocDuoiDat::where('status', '1')->get()->count();
        $gp_ktnuocduoidatChuaDuocDuyet = GPKTNuocDuoiDat::where('status', '0')->get()->count();
        $gp_ktnuocduoidatConHieuLuc = GPKTNuocDuoiDat::where('status', '1')->where('gp_ngayhethan','>',$currentDate)->get()->count();
        $gp_ktnuocduoidatSapHetHieuLuc = GPKTNuocDuoiDat::where('status', '1')->whereDate('gp_ngayhethan','<',Carbon::now()->addDays(60))->get()->count();
        $gp_ktnuocduoidatHetHieuLuc = GPKTNuocDuoiDat::where('status', '1')->where('gp_ngayhethan','<=',$currentDate)->get()->count();

        // gp_tdnuocduoidat
        $allgp_tdnuocduoidat = GPTDNuocDuoiDat::all()->count();
        $gp_tdnuocduoidatGPDaCap = GPTDNuocDuoiDat::where('status', '1')->get()->count();
        $gp_tdnuocduoidatChuaDuocDuyet = GPTDNuocDuoiDat::where('status', '0')->get()->count();
        $gp_tdnuocduoidatConHieuLuc = GPTDNuocDuoiDat::where('status', '1')->where('gp_ngayhethan','>',$currentDate)->get()->count();
        $gp_tdnuocduoidatSapHetHieuLuc = GPTDNuocDuoiDat::where('status', '1')->whereDate('gp_ngayhethan','<',Carbon::now()->addDays(60))->get()->count();
        $gp_tdnuocduoidatHetHieuLuc = GPTDNuocDuoiDat::where('status', '1')->where('gp_ngayhethan','<=',$currentDate)->get()->count();
        
        // gp_khoannuocduoidat
        $allgp_khoannuocduoidat = GPKhoanNuocDuoiDat::all()->count();
        $gp_khoannuocduoidatGPDaCap = GPKhoanNuocDuoiDat::where('status', '1')->get()->count();
        $gp_khoannuocduoidatChuaDuocDuyet = GPKhoanNuocDuoiDat::where('status', '0')->get()->count();
        $gp_khoannuocduoidatConHieuLuc = GPKhoanNuocDuoiDat::where('status', '1')->where('gp_ngayhethan','>',$currentDate)->get()->count();
        $gp_khoannuocduoidatSapHetHieuLuc = GPKhoanNuocDuoiDat::where('status', '1')->whereDate('gp_ngayhethan','<',Carbon::now()->addDays(60))->get()->count();
        $gp_khoannuocduoidatHetHieuLuc = GPKhoanNuocDuoiDat::where('status', '1')->where('gp_ngayhethan','<=',$currentDate)->get()->count();

        // gp_nuocmat
        $allgp_nuocmat = GPNuocMat::all()->count();
        $gp_nuocmatGPDaCap = GPNuocMat::where('status', '1')->get()->count();
        $gp_nuocmatChuaDuocDuyet = GPNuocMat::where('status', '0')->get()->count();
        $gp_nuocmatConHieuLuc = GPNuocMat::where('status', '1')->where('gp_ngayhethan','>',$currentDate)->get()->count();
        $gp_nuocmatSapHetHieuLuc = GPNuocMat::where('status', '1')->whereDate('gp_ngayhethan','<',Carbon::now()->addDays(60))->get()->count();
        $gp_nuocmatHetHieuLuc = GPNuocMat::where('status', '1')->where('gp_ngayhethan','<=',$currentDate)->get()->count();


        return [
        'gp_ktnuocduoidat' => [
                'tat_ca_giay_phep' => $allgp_ktnuocduoidat,
                'giay_phep_da_cap' => $gp_ktnuocduoidatGPDaCap,
                'chua_phe_duyet' => $gp_ktnuocduoidatChuaDuocDuyet,
                'con_hieu_luc' => $gp_ktnuocduoidatConHieuLuc,
                'sap_het_hieu_luc' => $gp_ktnuocduoidatSapHetHieuLuc,
                'het_hieu_luc' => $gp_ktnuocduoidatHetHieuLuc,
            ],
        'gp_tdnuocduoidat' => [
            'tat_ca_giay_phep' => $allgp_tdnuocduoidat,
            'giay_phep_da_cap' => $gp_tdnuocduoidatGPDaCap,
            'chua_phe_duyet' => $gp_tdnuocduoidatChuaDuocDuyet,
            'con_hieu_luc' => $gp_tdnuocduoidatConHieuLuc,
            'sap_het_hieu_luc' => $gp_tdnuocduoidatSapHetHieuLuc,
            'het_hieu_luc' => $gp_tdnuocduoidatHetHieuLuc,
        ],
        'gp_khoannuocduoidat' => [
            'tat_ca_giay_phep' => $allgp_khoannuocduoidat,
            'giay_phep_da_cap' => $gp_khoannuocduoidatGPDaCap,
            'chua_phe_duyet' => $gp_khoannuocduoidatChuaDuocDuyet,
            'con_hieu_luc' => $gp_khoannuocduoidatConHieuLuc,
            'sap_het_hieu_luc' => $gp_khoannuocduoidatSapHetHieuLuc,
            'het_hieu_luc' => $gp_khoannuocduoidatHetHieuLuc,
        ],
        'gp_nuocmat' => [
                'tat_ca_giay_phep' => $allgp_nuocmat,
                'giay_phep_da_cap' => $gp_nuocmatGPDaCap,
                'chua_phe_duyet' => $gp_nuocmatChuaDuocDuyet,
                'con_hieu_luc' => $gp_nuocmatConHieuLuc,
                'sap_het_hieu_luc' => $gp_nuocmatSapHetHieuLuc,
                'het_hieu_luc' => $gp_nuocmatHetHieuLuc,
            ],
        ];
    }
    public function countLicenseFolowType()
    {
        // gp nuocmat
        $gp_nuocmat2015 = GPNuocMat::where('status','1')->whereYear('gp_ngayky', '2015')->get()->count();
        $gp_nuocmat2016 = GPNuocMat::where('status','1')->whereYear('gp_ngayky', '2016')->get()->count();
        $gp_nuocmat2017 = GPNuocMat::where('status','1')->whereYear('gp_ngayky', '2017')->get()->count();
        $gp_nuocmat2018 = GPNuocMat::where('status','1')->whereYear('gp_ngayky', '2018')->get()->count();
        $gp_nuocmat2019 = GPNuocMat::where('status','1')->whereYear('gp_ngayky', '2019')->get()->count();
        $gp_nuocmat2020 = GPNuocMat::where('status','1')->whereYear('gp_ngayky', '2020')->get()->count();

        // gp ktnuocduoidat
        $gp_ktnuocduoidat2015 = GPKTNuocDuoiDat::where('status','1')->whereYear('gp_ngayky', '2015')->get()->count();
        $gp_ktnuocduoidat2016 = GPKTNuocDuoiDat::where('status','1')->whereYear('gp_ngayky', '2016')->get()->count();
        $gp_ktnuocduoidat2017 = GPKTNuocDuoiDat::where('status','1')->whereYear('gp_ngayky', '2017')->get()->count();
        $gp_ktnuocduoidat2018 = GPKTNuocDuoiDat::where('status','1')->whereYear('gp_ngayky', '2018')->get()->count();
        $gp_ktnuocduoidat2019 = GPKTNuocDuoiDat::where('status','1')->whereYear('gp_ngayky', '2019')->get()->count();
        $gp_ktnuocduoidat2020 = GPKTNuocDuoiDat::where('status','1')->whereYear('gp_ngayky', '2020')->get()->count();

        // gp tdnuocduoidat
        $gp_tdnuocduoidat2015 = GPTDNuocDuoiDat::where('status','1')->whereYear('gp_ngayky', '2015')->get()->count();
        $gp_tdnuocduoidat2016 = GPTDNuocDuoiDat::where('status','1')->whereYear('gp_ngayky', '2016')->get()->count();
        $gp_tdnuocduoidat2017 = GPTDNuocDuoiDat::where('status','1')->whereYear('gp_ngayky', '2017')->get()->count();
        $gp_tdnuocduoidat2018 = GPTDNuocDuoiDat::where('status','1')->whereYear('gp_ngayky', '2018')->get()->count();
        $gp_tdnuocduoidat2019 = GPTDNuocDuoiDat::where('status','1')->whereYear('gp_ngayky', '2019')->get()->count();
        $gp_tdnuocduoidat2020 = GPTDNuocDuoiDat::where('status','1')->whereYear('gp_ngayky', '2020')->get()->count();

        // gp khoannuocduoidat
        $gp_khoannuocduoidat2015 = GPKhoanNuocDuoiDat::where('status','1')->whereYear('gp_ngayky', '2015')->get()->count();
        $gp_khoannuocduoidat2016 = GPKhoanNuocDuoiDat::where('status','1')->whereYear('gp_ngayky', '2016')->get()->count();
        $gp_khoannuocduoidat2017 = GPKhoanNuocDuoiDat::where('status','1')->whereYear('gp_ngayky', '2017')->get()->count();
        $gp_khoannuocduoidat2018 = GPKhoanNuocDuoiDat::where('status','1')->whereYear('gp_ngayky', '2018')->get()->count();
        $gp_khoannuocduoidat2019 = GPKhoanNuocDuoiDat::where('status','1')->whereYear('gp_ngayky', '2019')->get()->count();
        $gp_khoannuocduoidat2020 = GPKhoanNuocDuoiDat::where('status','1')->whereYear('gp_ngayky', '2020')->get()->count();

        return[
            'gp_nuocmat' => [
                $gp_nuocmat2015,
                $gp_nuocmat2016,
                $gp_nuocmat2017,
                $gp_nuocmat2018,
                $gp_nuocmat2019,
                $gp_nuocmat2020,
            ],
            'gp_ktnuocduoidat' => [
                $gp_ktnuocduoidat2015,
                $gp_ktnuocduoidat2016,
                $gp_ktnuocduoidat2017,
                $gp_ktnuocduoidat2018,
                $gp_ktnuocduoidat2019,
                $gp_ktnuocduoidat2020,
            ],
            'gp_tdnuocduoidat' => [
                $gp_tdnuocduoidat2015,
                $gp_tdnuocduoidat2016,
                $gp_tdnuocduoidat2017,
                $gp_tdnuocduoidat2018,
                $gp_tdnuocduoidat2019,
                $gp_tdnuocduoidat2020,
            ],
            'gp_khoannuocduoidat' => [
                $gp_khoannuocduoidat2015,
                $gp_khoannuocduoidat2016,
                $gp_khoannuocduoidat2017,
                $gp_khoannuocduoidat2018,
                $gp_khoannuocduoidat2019,
                $gp_khoannuocduoidat2020,
            ],
            'gp_xathai' => [
                0,
                0,
                0,
                0,
                0,
                0,
            ],
        ];

    }
}

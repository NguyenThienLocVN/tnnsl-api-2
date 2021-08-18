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
        $gp_ktnuocduoidatSapHetHieuLuc = GPKTNuocDuoiDat::where('status', '1')->whereDate('gp_ngayhethan','<',Carbon::now()->addDays(90))->whereDate('gp_ngayhethan','>',Carbon::now())->get()->count();
        $gp_ktnuocduoidatHetHieuLuc = GPKTNuocDuoiDat::where('status', '1')->where('gp_ngayhethan','<=',$currentDate)->get()->count();

        // gp_tdnuocduoidat
        $allgp_tdnuocduoidat = GPTDNuocDuoiDat::all()->count();
        $gp_tdnuocduoidatGPDaCap = GPTDNuocDuoiDat::where('status', '1')->get()->count();
        $gp_tdnuocduoidatChuaDuocDuyet = GPTDNuocDuoiDat::where('status', '0')->get()->count();
        $gp_tdnuocduoidatConHieuLuc = GPTDNuocDuoiDat::where('status', '1')->where('gp_ngayhethan','>',$currentDate)->get()->count();
        $gp_tdnuocduoidatSapHetHieuLuc = GPTDNuocDuoiDat::where('status', '1')->whereDate('gp_ngayhethan','<',Carbon::now()->addDays(90))->whereDate('gp_ngayhethan','>',Carbon::now())->get()->count();
        $gp_tdnuocduoidatHetHieuLuc = GPTDNuocDuoiDat::where('status', '1')->where('gp_ngayhethan','<=',$currentDate)->get()->count();
        
        // gp_khoannuocduoidat
        $allgp_khoannuocduoidat = GPKhoanNuocDuoiDat::all()->count();
        $gp_khoannuocduoidatGPDaCap = GPKhoanNuocDuoiDat::where('status', '1')->get()->count();
        $gp_khoannuocduoidatChuaDuocDuyet = GPKhoanNuocDuoiDat::where('status', '0')->get()->count();
        $gp_khoannuocduoidatConHieuLuc = GPKhoanNuocDuoiDat::where('status', '1')->where('gp_ngayhethan','>',$currentDate)->get()->count();
        $gp_khoannuocduoidatSapHetHieuLuc = GPKhoanNuocDuoiDat::where('status', '1')->whereDate('gp_ngayhethan','<',Carbon::now()->addDays(90))->whereDate('gp_ngayhethan','>',Carbon::now())->get()->count();
        $gp_khoannuocduoidatHetHieuLuc = GPKhoanNuocDuoiDat::where('status', '1')->where('gp_ngayhethan','<=',$currentDate)->get()->count();

        // gp_nuocmat
        $allgp_nuocmat = GPNuocMat::all()->count();
        $gp_nuocmatGPDaCap = GPNuocMat::where('status', '1')->get()->count();
        $gp_nuocmatChuaDuocDuyet = GPNuocMat::where('status', '0')->get()->count();
        $gp_nuocmatConHieuLuc = GPNuocMat::where('status', '1')->where('gp_ngayhethan','>',$currentDate)->get()->count();
        $gp_nuocmatSapHetHieuLuc = GPNuocMat::where('status', '1')->whereDate('gp_ngayhethan','<',Carbon::now()->addDays(90))->whereDate('gp_ngayhethan','>',Carbon::now())->get()->count();
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
    public function countLicenseFolowType($startYear, $endYear)
    {
        $year = $startYear;

        $label = [];
        $data = [
            'gp_nuocmat' => [],
            'gp_ktnuocduoidat' => [],
            'gp_tdnuocduoidat' => [],
            'gp_khoannuocduoidat' => [],
            'gp_xathai' => [0,0,0,0,0],
        ];

        for($i = $startYear ; $i<= $endYear ; $i++){
            array_push($label, $i);

            $gp_nuocmat = GPNuocMat::where('status','1')->whereYear('gp_ngayky', $i)->get()->count();
            array_push($data['gp_nuocmat'], $gp_nuocmat);

            $gp_ktnuocduoidat = GPKTNuocDuoiDat::where('status','1')->whereYear('gp_ngayky', $i)->get()->count();
            array_push($data['gp_ktnuocduoidat'], $gp_ktnuocduoidat);

            $gp_tdnuocduoidat = GPTDNuocDuoiDat::where('status','1')->whereYear('gp_ngayky', $i)->get()->count();
            array_push($data['gp_tdnuocduoidat'], $gp_tdnuocduoidat);

            $gp_khoannuocduoidat = GPKhoanNuocDuoiDat::where('status','1')->whereYear('gp_ngayky', $i)->get()->count();
            array_push($data['gp_khoannuocduoidat'], $gp_khoannuocduoidat);
        }

        return [
            'label' => $label,
            'data' => $data,
        ];

    }
}

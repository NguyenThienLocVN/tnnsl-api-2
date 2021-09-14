<?php

namespace App\Http\Controllers\api\QuanLyCapPhep;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;


use App\Models\QuanLyCapPhep\NuocMat\GPNuocMat;
use App\Models\QuanLyCapPhep\NuocDuoiDat\GPKTNuocDuoiDat;
use App\Models\QuanLyCapPhep\NuocDuoiDat\GPTDNuocDuoiDat;
use App\Models\QuanLyCapPhep\NuocDuoiDat\GPKhoanNuocDuoiDat;


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
            'gp_nuocmat' => [
                    'tat_ca_giay_phep' => $allgp_nuocmat,
                    'giay_phep_da_cap' => $gp_nuocmatGPDaCap,
                    'chua_phe_duyet' => $gp_nuocmatChuaDuocDuyet,
                    'con_hieu_luc' => $gp_nuocmatConHieuLuc,
                    'sap_het_hieu_luc' => $gp_nuocmatSapHetHieuLuc,
                    'het_hieu_luc' => $gp_nuocmatHetHieuLuc,
            ],
            'gp_xathai' => [
                'tat_ca_giay_phep' => 64,
                'giay_phep_da_cap' => 64,
                'chua_phe_duyet' => 0,
                'con_hieu_luc' => 47,
                'sap_het_hieu_luc' => 0,
                'het_hieu_luc' => 17,
            ],
        ];
    }
    public function countLicenseFolowType($startYear, $endYear)
    {
        $currentDate = Carbon::now();
        $year = $startYear;

        $label = [];

        // gp_ktnuocduoidat
        $gp_ktnuocduoidatChuaDuocDuyet = GPKTNuocDuoiDat::where('status', '0')->get()->count();
        $gp_ktnuocduoidatConHieuLuc = GPKTNuocDuoiDat::where('status', '1')->where('gp_ngayhethan','>',$currentDate)->get()->count();
        $gp_ktnuocduoidatSapHetHieuLuc = GPKTNuocDuoiDat::where('status', '1')->whereDate('gp_ngayhethan','<',Carbon::now()->addDays(90))->whereDate('gp_ngayhethan','>',Carbon::now())->get()->count();
        $gp_ktnuocduoidatHetHieuLuc = GPKTNuocDuoiDat::where('status', '1')->where('gp_ngayhethan','<=',$currentDate)->get()->count();
       
        // gp_nuocmat
        $gp_nuocmatChuaDuocDuyet = GPNuocMat::where('status', '0')->get()->count();
        $gp_nuocmatConHieuLuc = GPNuocMat::where('status', '1')->where('gp_ngayhethan','>',$currentDate)->get()->count();
        $gp_nuocmatSapHetHieuLuc = GPNuocMat::where('status', '1')->whereDate('gp_ngayhethan','<',Carbon::now()->addDays(90))->whereDate('gp_ngayhethan','>',Carbon::now())->get()->count();
        $gp_nuocmatHetHieuLuc = GPNuocMat::where('status', '1')->where('gp_ngayhethan','<=',$currentDate)->get()->count();

        $dataDoughnut = [
            'gp_nuocmat' => [$gp_nuocmatConHieuLuc, $gp_nuocmatSapHetHieuLuc, $gp_nuocmatHetHieuLuc, $gp_nuocmatChuaDuocDuyet],
            'gp_ktnuocduoidat' => [$gp_ktnuocduoidatConHieuLuc, $gp_ktnuocduoidatSapHetHieuLuc, $gp_ktnuocduoidatHetHieuLuc, $gp_ktnuocduoidatChuaDuocDuyet],
            'gp_xathai' => [47, 0, 17, 0],
        ];

        $data = [
            'gp_nuocmat' => [],
            'gp_ktnuocduoidat' => [],
            'gp_xathai' => [5, 7, 7, 4, 2],
        ];

        for($i = $startYear ; $i<= $endYear ; $i++){
            array_push($label, (int)$i);

            $gp_nuocmat = GPNuocMat::where('status','1')->whereYear('gp_ngayky', $i)->get()->count();
            array_push($data['gp_nuocmat'], $gp_nuocmat);

            $gp_ktnuocduoidat = GPKTNuocDuoiDat::where('status','1')->whereYear('gp_ngayky', $i)->get()->count();
            array_push($data['gp_ktnuocduoidat'], $gp_ktnuocduoidat);
        }

        return [
            'label' => $label,
            'data' => $data,
            'dataDoughnut' => $dataDoughnut
        ];
    }
}

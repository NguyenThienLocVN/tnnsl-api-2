<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GPNuocMat;
use App\Models\GPKTSDNuocDuoiDat;
use Carbon\Carbon;

class QuanLyCapPhepController extends Controller
{
    public function countLicense()
    {
        $currentDate = Carbon::now();

        $allgp_ktsdnuocduoidat = GPKTSDNuocDuoiDat::all()->count();

        $gp_ktsdnuocduoidatGPDaCap = GPKTSDNuocDuoiDat::where('status', '1')->get()->count();

        $gp_ktsdnuocduoidatChuaDuocDuyet = GPKTSDNuocDuoiDat::where('status', '0')->get()->count();

        $gp_ktsdnuocduoidatConHieuLuc = GPKTSDNuocDuoiDat::where('status', '1')->where('gp_ngayhethan','>',$currentDate)->get()->count();

        $gp_ktsdnuocduoidatSapHetHieuLuc = GPKTSDNuocDuoiDat::where('status', '1')->whereDate('gp_ngayhethan','<',Carbon::now()->addDays(60))->get()->count();

        $gp_ktsdnuocduoidatHetHieuLuc = GPKTSDNuocDuoiDat::where('status', '1')->where('gp_ngayhethan','<',$currentDate)->get()->count();

        $allgp_nuocmat = GPNuocMat::all()->count();
        $gp_nuocmatGPDaCap = GPNuocMat::where('status', '1')->get()->count();
        // gp chưa được duyệt
        $gp_nuocmatChuaDuocDuyet = GPNuocMat::where('status', '0')->get()->count();
        // gp còn hiệu lực
        $gp_nuocmatConHieuLuc = GPNuocMat::where('status', '1')->where('gp_ngayhethan','>',$currentDate)->get()->count();
        // gp sắp hết hiệu lực
        $gp_nuocmatSapHetHieuLuc = GPNuocMat::where('status', '1')->whereDate('gp_ngayhethan','<',Carbon::now()->addDays(60))->get()->count();

        $gp_nuocmatHetHieuLuc = GPNuocMat::where('status', '1')->where('gp_ngayhethan','<',$currentDate)->get()->count();


        return [
        'gp_ktsdnuocduoidat' => [
                'tat_ca_giay_phep' => $allgp_ktsdnuocduoidat,
                'giay_phep_da_cap' => $gp_ktsdnuocduoidatGPDaCap,
                'chua_phe_duyet' => $gp_ktsdnuocduoidatChuaDuocDuyet,
                'con_hieu_luc' => $gp_ktsdnuocduoidatConHieuLuc,
                'sap_het_hieu_luc' => $gp_ktsdnuocduoidatSapHetHieuLuc,
                'het_hieu_luc' => $gp_ktsdnuocduoidatHetHieuLuc,
            ],
        'gp_nuocmat' => [
                'tat_ca_giay_phep' => $allgp_nuocmat,
                'giay_phep_da_cap' => $gp_nuocmatGPDaCap,
                'chua_phe_duyet' => $gp_nuocmatChuaDuocDuyet,
                'con_hieu_luc' => $gp_nuocmatConHieuLuc,
                'sap_het_hieu_luc' => $gp_nuocmatSapHetHieuLuc,
                'het_hieu_luc' => $gp_nuocmatHetHieuLuc,
            ]
        ];
    }
    public function countLicenseFolowYear()
    {
        // gp nuocmat
        $gp_nuocmat2015 = GPNuocMat::where('status','1')->whereYear('gp_ngayky', '2015')->get()->count();
        $gp_nuocmat2016 = GPNuocMat::where('status','1')->whereYear('gp_ngayky', '2016')->get()->count();
        $gp_nuocmat2017 = GPNuocMat::where('status','1')->whereYear('gp_ngayky', '2017')->get()->count();
        $gp_nuocmat2018 = GPNuocMat::where('status','1')->whereYear('gp_ngayky', '2018')->get()->count();
        $gp_nuocmat2019 = GPNuocMat::where('status','1')->whereYear('gp_ngayky', '2019')->get()->count();
        $gp_nuocmat2020 = GPNuocMat::where('status','1')->whereYear('gp_ngayky', '2020')->get()->count();

        // gp ktsdnuocduoidat
        $gp_nuocduoidat2015 = GPKTSDNuocDuoiDat::where('status','1')->whereYear('gp_ngayky', '2015')->get()->count();
        $gp_nuocduoidat2016 = GPKTSDNuocDuoiDat::where('status','1')->whereYear('gp_ngayky', '2016')->get()->count();
        $gp_nuocduoidat2017 = GPKTSDNuocDuoiDat::where('status','1')->whereYear('gp_ngayky', '2017')->get()->count();
        $gp_nuocduoidat2018 = GPKTSDNuocDuoiDat::where('status','1')->whereYear('gp_ngayky', '2018')->get()->count();
        $gp_nuocduoidat2019 = GPKTSDNuocDuoiDat::where('status','1')->whereYear('gp_ngayky', '2019')->get()->count();
        $gp_nuocduoidat2020 = GPKTSDNuocDuoiDat::where('status','1')->whereYear('gp_ngayky', '2020')->get()->count();

        return[
            'gp_nuocmat' => [
                '2015' => $gp_nuocmat2015,
                '2016' => $gp_nuocmat2016,
                '2017' => $gp_nuocmat2017,
                '2018' => $gp_nuocmat2018,
                '2019' => $gp_nuocmat2019,
                '2020' => $gp_nuocmat2020,
            ],
            'gp_ktsdnuocduoidat' => [
                '2015' => $gp_nuocduoidat2015,
                '2016' => $gp_nuocduoidat2016,
                '2017' => $gp_nuocduoidat2017,
                '2018' => $gp_nuocduoidat2018,
                '2019' => $gp_nuocduoidat2019,
                '2020' => $gp_nuocduoidat2020,
            ]
        ];

    }
}

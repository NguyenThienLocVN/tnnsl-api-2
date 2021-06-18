<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\GPNuocMat;
use App\Models\ChatLuongNuocMatQCVN;
use App\Models\HangMucCongTrinh;
use Carbon\Carbon;

class GPNuocMatController extends Controller
{
    // list all license
    public function allLicenses(){
        $constructs = GPNuocMat::all();
        return $constructs;
    }

    // countLicenceNumber
    public function countLicenceNumber(){

        $currentDate = Carbon::now();

        // All License
        $allChuaDuocDuyet = GPNuocMat::where('status', '0')->get()->count();

        $allConHieuLuc = GPNuocMat::where('status', '1')->where('gp_ngayhethan','>',$currentDate)->get()->count();

        $allSapHetHieuLuc = GPNuocMat::where('status', '1')->whereDate('gp_ngayhethan','<',Carbon::now()->addDays(60))->get()->count();

        $allHetHieuLuc = GPNuocMat::where('status', '1')->where('gp_ngayhethan','<',$currentDate)->get()->count();

        // Hydroelectric License
        $allHydroelectric = GPNuocMat::where('loaihinh_congtrinh_ktsd','thuy-dien')->count();

        $hydroelectricGPDaCap = GPNuocMat::where('status', '1')->where('loaihinh_congtrinh_ktsd', 'thuy-dien')->get()->count();

        $hydroelectricChuaDuocDuyet = GPNuocMat::where('status', '0')->where('loaihinh_congtrinh_ktsd', 'thuy-dien')->get()->count();

        $hydroelectricConHieuLuc = GPNuocMat::where('status', '1')->where('loaihinh_congtrinh_ktsd', 'thuy-dien')->where('gp_ngayhethan','>',$currentDate)->get()->count();

        $hydroelectricSapHetHieuLuc = GPNuocMat::where('status', '1')->whereDate('gp_ngayhethan','<',Carbon::now()->addDays(60))->where('loaihinh_congtrinh_ktsd', 'thuy-dien')->get()->count();

        $hydroelectricHetHieuLuc = GPNuocMat::where('status', '1')->where('loaihinh_congtrinh_ktsd', 'thuy-dien')->where('gp_ngayhethan','<',$currentDate)->get()->count();



        return [
            'tat_ca_gp_nuoc_mat' => [
                'chua_phe_duyet' => $allChuaDuocDuyet,
                'con_hieu_luc' => $allConHieuLuc,
                'sap_het_hieu_luc' => $allSapHetHieuLuc,
                'het_hieu_luc' => $allHetHieuLuc,
            ],
            'thuy_dien' => [
                'tat_ca_giay_phep' => $allHydroelectric,
                'giay_phep_da_cap' => $hydroelectricGPDaCap,
                'chua_phe_duyet' => $hydroelectricChuaDuocDuyet,
                'con_hieu_luc' => $hydroelectricConHieuLuc,
                'sap_het_hieu_luc' => $hydroelectricSapHetHieuLuc,
                'het_hieu_luc' => $hydroelectricHetHieuLuc,
            ],
        ];
    }

    // listHydroelectricLicense 
    public function listHydroelectricLicense(){
        $constructs = GPNuocMat::where('loaihinh_congtrinh_ktsd', 'thuy-dien')->with('hang_muc_ct')->with('tai_lieu')->with('luu_luong_theo_muc_dich_sd')->get();
        return $constructs;
    }

    // hydroelectricLicenseInfo
    public function hydroelectricLicenseInfo($id_gp){
        $construct = GPNuocMat::with('hang_muc_ct')->find($id_gp);
        return $construct;
    }

    // TrafficAccordingToThePurposeOfUse
    public function TrafficAccordingToThePurposeOfUse($id_gp){
        $license =  GPNuocMat::find($id_gp);
        return $license->luu_luong_theo_muc_dich_sd;
    }

    // chat_luong_nuoc_mat_qcvn
    public function chat_luong_nuoc_mat_qcvn(){
        return ChatLuongNuocMatQCVN::all();
    }

    // Lay toa do lat long cua cong trinh thuy dien
    public function getInfoHydroelectricForMap(){
        $constructs = GPNuocMat::where('loaihinh_congtrinh_ktsd', 'thuy-dien')->with('hang_muc_ct')->get()->toArray();
        
        return $constructs;
    }
}

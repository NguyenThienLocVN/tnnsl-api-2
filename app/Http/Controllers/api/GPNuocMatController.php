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
    // list all Face water license
    public function allFaceWaterLicenses(){
        $license = GPNuocMat::all();
        // gp thủy điện
        $gp_thuydien = GPNuocMat::where('loaihinh_congtrinh_ktsd', 'thuy-dien')->with('hang_muc_ct')->with('tai_lieu')->with('luu_luong_theo_muc_dich_sd')->get();
        // gp hồ chứa
        $gp_hochua = GPNuocMat::where('loaihinh_congtrinh_ktsd', 'ho-chua')->with('hang_muc_ct')->with('tai_lieu')->with('luu_luong_theo_muc_dich_sd')->get();
        // gp trạm bơm
        $gp_trambom = GPNuocMat::where('loaihinh_congtrinh_ktsd', 'tram-bom')->with('hang_muc_ct')->with('tai_lieu')->with('luu_luong_theo_muc_dich_sd')->get();
        // gp đập/ hệ thống thủy lợi
        $gp_dap = GPNuocMat::where('loaihinh_congtrinh_ktsd', 'dap')->with('hang_muc_ct')->with('tai_lieu')->with('luu_luong_theo_muc_dich_sd')->get();
        // gp Cống
        $gp_cong = GPNuocMat::where('loaihinh_congtrinh_ktsd', 'cong')->with('hang_muc_ct')->with('tai_lieu')->with('luu_luong_theo_muc_dich_sd')->get(); 
        // gp trạm cấp nước
        $gp_tramcapnuoc = GPNuocMat::where('loaihinh_congtrinh_ktsd', 'tram-cap-nuoc')->with('hang_muc_ct')->with('tai_lieu')->with('luu_luong_theo_muc_dich_sd')->get();
        // gp nhà máy nước
        $gp_nhamaynuoc = GPNuocMat::where('loaihinh_congtrinh_ktsd', 'nha-may-nuoc')->with('hang_muc_ct')->with('tai_lieu')->with('luu_luong_theo_muc_dich_sd')->get();
        // gp công trình khác
        $gp_congtrinhkhac = GPNuocMat::where('loaihinh_congtrinh_ktsd', 'cong-trinh-khac')->with('hang_muc_ct')->with('tai_lieu')->with('luu_luong_theo_muc_dich_sd')->get();
        return [
            'giayphep' => [
                'gp_all' => $license,
                'gp_thuydien' => $gp_thuydien,
                'gp_hochua' => $gp_hochua,
                'gp_dap' => $gp_dap,
                'gp_cong' => $gp_cong,
                'gp_trambom' => $gp_trambom,
                'gp_tramcapnuoc' => $gp_tramcapnuoc,
                'gp_nhamaynuoc' => $gp_nhamaynuoc,
                'gp_congtrinhkhac' => $gp_congtrinhkhac,
            ]
        ];
    }

    // countLicenceNumber
    public function countLicenceNumber(){

        $currentDate = Carbon::now();

        // gp chưa được duyệt
        $allChuaDuocDuyet = GPNuocMat::where('status', '0')->get()->count();
        // gp còn hiệu lực
        $allConHieuLuc = GPNuocMat::where('status', '1')->where('gp_ngayhethan','>',$currentDate)->get()->count();
        // gp sắp hết hiệu lực
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
        $license = GPNuocMat::where('loaihinh_congtrinh_ktsd', 'thuy-dien')->with('hang_muc_ct')->with('tai_lieu')->with('luu_luong_theo_muc_dich_sd')->get();
        return $license;
    }
    // listReservoirLicense 
    public function listReservoirLicense(){
        $license = GPNuocMat::where('loaihinh_congtrinh_ktsd', 'ho-chua')->with('hang_muc_ct')->with('tai_lieu')->with('luu_luong_theo_muc_dich_sd')->get();
        return $license;
    }
    // listPumpingStationLicense 
    public function listPumpingStationLicense(){
        $license = GPNuocMat::where('loaihinh_congtrinh_ktsd', 'tram-bom')->with('hang_muc_ct')->with('tai_lieu')->with('luu_luong_theo_muc_dich_sd')->get();
        return $license;
    }
    // listWaterSupplyStationLicense 
    public function listWaterSupplyStationLicense(){
        $license = GPNuocMat::where('loaihinh_congtrinh_ktsd', 'tram-cap-nuoc')->with('hang_muc_ct')->with('tai_lieu')->with('luu_luong_theo_muc_dich_sd')->get();
        return $license;
    }

    // hydroelectricLicenseInfo
    public function hydroelectricLicenseInfo($id_gp){
        $LicenseInfo = GPNuocMat::with('hang_muc_ct')->find($id_gp);
        return $LicenseInfo;
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

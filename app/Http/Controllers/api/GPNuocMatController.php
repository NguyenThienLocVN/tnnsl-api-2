<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\GPNuocMat;
use Carbon\Carbon;

class GPNuocMatController extends Controller
{
    // danh sach tat ca giay phep 
    public function allLicenses(){
        $constructs = GPNuocMat::all();
        return $constructs;
    }

    // dem so giay phep
    public function countLicenceNumber(){

        $currentDate = Carbon::now();

        // All License
        $allChuaDuocDuyet = GPNuocMat::where('status', '0')->get()->count();
        $allConHieuLuc = GPNuocMat::where('status', '1')->where('hieu_luc_den','>',$currentDate)->get()->count();
        $allSapHetHieuLuc = GPNuocMat::where('status', '1')->whereDate('hieu_luc_den','<',Carbon::now()->addDays(60))->get()->count();
        $allHetHieuLuc = GPNuocMat::where('status', '1')->where('hieu_luc_den','<',$currentDate)->get()->count();

        // Hydroelectric License
        $hydroelectricChuaDuocDuyet = GPNuocMat::where('status', '0')->where('loai_ct', 'thuy-dien')->get()->count();

        return [
            'tat_ca_gp_nuoc_mat' => [
                'chua_phe_duyet' => $allChuaDuocDuyet,
                'con_hieu_luc' => $allConHieuLuc,
                'sap_het_hieu_luc' => ($allSapHetHieuLuc-$allHetHieuLuc),
                'het_hieu_luc' => $allHetHieuLuc,
            ],
            'thuy-dien' => [
                'chua_phe_duyet' => '1',
                'con_hieu_luc' => '1',
                'sap_het_hieu_luc' => '1',
                'het_hieu_luc' => '1',
            ],
        ];
    }

    // danh sach giay phep thuy dien
    public function listHydroelectricLicense(){
        $constructs = GPNuocMat::where('loai_ct', 'thuy-dien')->with('hang_muc_ct')->get();
        return $constructs;
    }

    // Hang muc cong trinh
    public function constructionItems($id_gp){
        $license =  GPNuocMat::find($id_gp);
        return $license->hang_muc_ct;
    }

    // luu_luong_theo_muc_dich_sd
    public function TrafficAccordingToThePurposeOfUse($id_gp){
        $license =  GPNuocMat::find($id_gp);
        return $license->luu_luong_theo_muc_dich_sd;
    }
}

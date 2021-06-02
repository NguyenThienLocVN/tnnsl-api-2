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
        $chuaDuocDuyet = GPNuocMat::where('status', '0')->get()->count();
        $conHieuLuc = GPNuocMat::where('status', '1')->where('hieu_luc_den','>',$currentDate)->get()->count();
        $sapHetHieuLuc = GPNuocMat::where('status', '1')->whereDate('hieu_luc_den','<',Carbon::now()->addDays(60))->get()->count();
        $hetHieuLuc = GPNuocMat::where('status', '1')->where('hieu_luc_den','<',$currentDate)->get()->count();

        return [
            'chua_phe_duyet' => $chuaDuocDuyet,
            'con_hieu_luc' => $conHieuLuc,
            'sap_het_hieu_luc' => ($sapHetHieuLuc-$hetHieuLuc),
            'het_hieu_luc' => $hetHieuLuc,
        ];
    }

    // danh sach giay phep thuy dien
    public function listHydroelectricLicense(){
        $constructs = GPNuocMat::where('loai_ct', 'thuy-dien')->get();
        return $constructs;
    }

    // Hang muc cong trinh
    public function constructionItems($id_gp){
        $license =  GPNuocMat::find($id_gp);
        return $license->hang_muc_ct;
    }

    // Hang muc cong trinh
    public function TrafficAccordingToThePurposeOfUse($id_gp){
        $license =  GPNuocMat::find($id_gp);
        return $license->luu_luong_theo_muc_dich_sd;
    }
}

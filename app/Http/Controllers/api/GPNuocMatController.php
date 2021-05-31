<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\GPNuocMat;

class GPNuocMatController extends Controller
{
    // danh sach giay phep thuy dien
    public function listHydroelectricLicense(){
        $constructs = GPNuocMat::where('loai_ct', 1)->get();
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

<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\GPKTNuocDuoiDat;
use App\Models\User;
use Carbon\Carbon;

class GPKTNuocDuoiDatController extends Controller
{
    public function license()
    {
        $license = GPKTNuocDuoiDat::with('hang_muc_ct')->paginate(10);
        $sumLicense = GPKTNuocDuoiDat::all()->count();
        return [
            'gp_ktnuocduoidat' => $license,
            'tonggp_ktnuocduoidat' => $sumLicense,
        ];
    }
    public function countLicense()
    {
        $currentDate = Carbon::now();

        $allgp_ktsdnuocduoidat = GPKTNuocDuoiDat::all()->count();

        $gp_ktsdnuocduoidatGPDaCap = GPKTNuocDuoiDat::where('status', '1')->get()->count();

        $gp_ktsdnuocduoidatConHieuLuc = GPKTNuocDuoiDat::where('status', '1')->where('gp_ngayhethan','>',$currentDate)->get()->count();

        $gp_ktsdnuocduoidatSapHetHieuLuc = GPKTNuocDuoiDat::where('status', '1')->whereDate('gp_ngayhethan','<',Carbon::now()->addDays(60))->get()->count();

        $gp_ktsdnuocduoidatHetHieuLuc = GPKTNuocDuoiDat::where('status', '1')->where('gp_ngayhethan','<',$currentDate)->get()->count();


        return [
        'gp_ktsdnuocduoidat' => [
                'tat_ca_giay_phep' => $allgp_ktsdnuocduoidat,
                'giay_phep_da_cap' => $gp_ktsdnuocduoidatGPDaCap,
                'chua_phe_duyet' => $allgp_ktsdnuocduoidat - $gp_ktsdnuocduoidatGPDaCap,
                'con_hieu_luc' => $gp_ktsdnuocduoidatConHieuLuc,
                'sap_het_hieu_luc' => $gp_ktsdnuocduoidatSapHetHieuLuc,
                'het_hieu_luc' => $gp_ktsdnuocduoidatHetHieuLuc,
            ],
        ];
    }
    public function singleLicense($id_gp){
        $LicenseInfo = GPKTNuocDuoiDat::where('id', $id_gp)->with('hang_muc_ct')->get();
        return $LicenseInfo;
    }
    public function NewLicenseManagement($user_id)
    {
        $roleAdmin = GPKTNuocDuoiDat::whereIn('status', [0,2,3])->paginate(10);
        $roleUser = GPKTNuocDuoiDat::where('user_id', $user_id)->paginate(10);
        return[
            'role_admin' => $roleAdmin,
            'role_user' => $roleUser,
        ];
    }
}

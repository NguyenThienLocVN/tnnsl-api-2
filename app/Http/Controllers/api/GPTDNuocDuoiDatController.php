<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use App\Models\GPTDNuocDuoiDat;

class GPTDNuocDuoiDatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }

    public function license()
    {
        $license = GPTDNuocDuoiDat::with('toado_congtrinh')->with('tailieu_thamdo')->get();
        return $license;
    }
    public function countLicense()
    {
        $currentDate = Carbon::now();

        $allgp_tdnuocduoidat = GPTDNuocDuoiDat::all()->count();

        $gp_tdnuocduoidatGPDaCap = GPTDNuocDuoiDat::where('status', '1')->get()->count();

        $gp_tdnuocduoidatConHieuLuc = GPTDNuocDuoiDat::where('status', '1')->where('gp_ngayhethan','>',$currentDate)->get()->count();

        $gp_tdnuocduoidatSapHetHieuLuc = GPTDNuocDuoiDat::where('status', '1')->whereDate('gp_ngayhethan','<',Carbon::now()->addDays(90))->whereDate('gp_ngayhethan','>',Carbon::now())->get()->count();

        $gp_tdnuocduoidatHetHieuLuc = GPTDNuocDuoiDat::where('status', '1')->where('gp_ngayhethan','<',$currentDate)->get()->count();


        return [
        'gp_tdnuocduoidat' => [
                'tat_ca_giay_phep' => $allgp_tdnuocduoidat,
                'giay_phep_da_cap' => $gp_tdnuocduoidatGPDaCap,
                'chua_phe_duyet' => $allgp_tdnuocduoidat - $gp_tdnuocduoidatGPDaCap,
                'con_hieu_luc' => $gp_tdnuocduoidatConHieuLuc,
                'sap_het_hieu_luc' => $gp_tdnuocduoidatSapHetHieuLuc,
                'het_hieu_luc' => $gp_tdnuocduoidatHetHieuLuc,
            ],
        ];
    }
    public function filterLicense($status)
    {
        $currentDate = Carbon::now();

        $all = GPTDNuocDuoiDat::with('toado_congtrinh')->with('tailieu_thamdo')->get();

        $chuaPheDuyet = GPTDNuocDuoiDat::where('status', '0')->get();

        $conHieuLuc = GPTDNuocDuoiDat::with('toado_congtrinh')->with('tailieu_thamdo')->where('status', '1')->where('gp_ngayhethan','>',$currentDate)->get();

        $sapHetHieuLuc = GPTDNuocDuoiDat::where('status', '1')->whereDate('gp_ngayhethan','<',Carbon::now()->addDays(90))->whereDate('gp_ngayhethan','>',Carbon::now())->get();

        $hetHieuLuc = GPTDNuocDuoiDat::with('toado_congtrinh')->with('tailieu_thamdo')->where('status', '1')->where('gp_ngayhethan','<',$currentDate)->get();

        if($status == "all"){
            return $all;
        }elseif($status == "conhieuluc"){
            return $conHieuLuc;
        }elseif($status == "chuapheduyet"){
            return $chuaPheDuyet;
        }elseif($status == "hethieuluc"){
            return $hetHieuLuc;
        }elseif($status == "saphethieuluc"){
            return $sapHetHieuLuc;
        }
    }
    public function singleLicense($id_gp)
    {
        $LicenseInfo = GPTDNuocDuoiDat::where('id', $id_gp)->with('toado_congtrinh')->with('tailieu_thamdo')->get();
        return $LicenseInfo;
    }
    public function NewLicenseManagement($user_id, $status)
    {
        $role = User::where('id',$user_id)->get()->pluck('role');

        $currentDate = Carbon::now();
        // role admin

        $adminAll = GPTDNuocDuoiDat::whereIn('status', [0,1,2,3])->with('toado_congtrinh')->with('tailieu_thamdo')->orderBy('id', 'DESC')->get();

        $adminNopHoSo = GPTDNuocDuoiDat::whereIn('status', [0])->with('toado_congtrinh')->with('tailieu_thamdo')->orderBy('id', 'DESC')->get();

        $adminDangLayYKienThamDinh = GPTDNuocDuoiDat::whereIn('status', [2])->with('toado_congtrinh')->with('tailieu_thamdo')->orderBy('id', 'DESC')->get();

        $adminHoanThanhHoSoCapPhep = GPTDNuocDuoiDat::whereIn('status', [3])->with('toado_congtrinh')->with('tailieu_thamdo')->orderBy('id', 'DESC')->get();

        $adminDaDuocCapPhep = GPTDNuocDuoiDat::whereIn('status', [1])->with('toado_congtrinh')->with('tailieu_thamdo')->orderBy('id', 'DESC')->get();

        // role user

        $userAll = GPTDNuocDuoiDat::where('user_id',$user_id)->whereIn('status', [0,1,2,3])->with('toado_congtrinh')->with('tailieu_thamdo')->orderBy('id', 'DESC')->get();

        $userNopHoSo = GPTDNuocDuoiDat::where('user_id',$user_id)->whereIn('status', [0])->with('toado_congtrinh')->with('tailieu_thamdo')->orderBy('id', 'DESC')->get();

        $userDangLayYKienThamDinh = GPTDNuocDuoiDat::where('user_id',$user_id)->whereIn('status', [2])->with('toado_congtrinh')->with('tailieu_thamdo')->orderBy('id', 'DESC')->get();

        $userHoanThanhHoSoCapPhep = GPTDNuocDuoiDat::where('user_id',$user_id)->whereIn('status', [3])->with('toado_congtrinh')->with('tailieu_thamdo')->orderBy('id', 'DESC')->get();

        $userDaDuocCapPhep = GPTDNuocDuoiDat::where('user_id',$user_id)->whereIn('status', [1])->with('toado_congtrinh')->with('tailieu_thamdo')->orderBy('id', 'DESC')->get();

        if($role[0] == "admin"){
            if($status == "all"){
                return $adminAll;
            }elseif($status == "2"){
                return $adminDangLayYKienThamDinh;
            }elseif($status == "0"){
                return $adminNopHoSo;
            }elseif($status == "3"){
                return $adminHoanThanhHoSoCapPhep;
            }elseif($status == "1"){
                return $adminDaDuocCapPhep;
            }
        }elseif($role[0] == "user"){
            if($status == "all"){
                return $userAll;
            }elseif($status == "2"){
                return $userDangLayYKienThamDinh;
            }elseif($status == "0"){
                return $userNopHoSo;
            }elseif($status == "3"){
                return $userHoanThanhHoSoCapPhep;
            }elseif($status == "1"){
                return $userDaDuocCapPhep;
            }
        }
    }
    public function destroyLicense($id_gp)
    {
        $destroyLicense = GPTDNuocDuoiDat::find($id_gp);
        $destroyLicense->delete();  
        return response()->json(['success_message' => 'Xóa giấy phép thành công !' ]);
    }
}

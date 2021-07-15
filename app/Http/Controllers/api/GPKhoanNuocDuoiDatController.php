<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\User;
use App\Models\GPKhoanNuocDuoiDat;

class GPKhoanNuocDuoiDatController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:sanctum');
    }
    public function countLicense()
    {
        $currentDate = Carbon::now();

        $allgp_tdnuocduoidat = GPKhoanNuocDuoiDat::all()->count();

        $gp_tdnuocduoidatGPDaCap = GPKhoanNuocDuoiDat::where('status', '1')->get()->count();

        $gp_tdnuocduoidatConHieuLuc = GPKhoanNuocDuoiDat::where('status', '1')->where('gp_ngayhethan','>',$currentDate)->get()->count();

        $gp_tdnuocduoidatSapHetHieuLuc = GPKhoanNuocDuoiDat::where('status', '1')->whereDate('gp_ngayhethan','<=',Carbon::now()->addDays(60))->get()->count();

        $gp_tdnuocduoidatHetHieuLuc = GPKhoanNuocDuoiDat::where('status', '1')->where('gp_ngayhethan','<',$currentDate)->get()->count();


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

        $all = GPKhoanNuocDuoiDat::with('tailieu_khoan')->get();

        $chuaPheDuyet = GPKhoanNuocDuoiDat::where('status', '0')->get();

        $conHieuLuc = GPKhoanNuocDuoiDat::with('tailieu_khoan')->where('status', '1')->where('gp_ngayhethan','>',$currentDate)->get();

        $sapHetHieuLuc = GPKhoanNuocDuoiDat::where('status', '1')->whereDate('gp_ngayhethan','<',Carbon::now()->addDays(60))->get();

        $hetHieuLuc = GPKhoanNuocDuoiDat::with('tailieu_khoan')->where('status', '1')->where('gp_ngayhethan','<',$currentDate)->get();

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
        $LicenseInfo = GPKhoanNuocDuoiDat::where('id', $id_gp)->with('tailieu_khoan')->get();
        return $LicenseInfo;
    }
    public function NewLicenseManagement($user_id, $status)
    {
        $role = User::where('id',$user_id)->get()->pluck('role');

        $currentDate = Carbon::now();
        // role admin

        $adminAll = GPKhoanNuocDuoiDat::whereIn('status', [0,1,2,3])->with('tailieu_khoan')->orderBy('id', 'DESC')->get();

        $adminNopHoSo = GPKhoanNuocDuoiDat::whereIn('status', [0])->with('tailieu_khoan')->orderBy('id', 'DESC')->get();

        $adminDangLayYKienThamDinh = GPKhoanNuocDuoiDat::whereIn('status', [2])->with('tailieu_khoan')->orderBy('id', 'DESC')->get();

        $adminHoanThanhHoSoCapPhep = GPKhoanNuocDuoiDat::whereIn('status', [3])->with('tailieu_khoan')->orderBy('id', 'DESC')->get();

        $adminDaDuocCapPhep = GPKhoanNuocDuoiDat::whereIn('status', [1])->with('tailieu_khoan')->orderBy('id', 'DESC')->get();

        // role user

        $userAll = GPKhoanNuocDuoiDat::where('user_id',$user_id)->whereIn('status', [0,1,2,3])->with('tailieu_khoan')->orderBy('id', 'DESC')->get();

        $userNopHoSo = GPKhoanNuocDuoiDat::where('user_id',$user_id)->whereIn('status', [0])->with('tailieu_khoan')->orderBy('id', 'DESC')->get();

        $userDangLayYKienThamDinh = GPKhoanNuocDuoiDat::where('user_id',$user_id)->whereIn('status', [2])->with('tailieu_khoan')->orderBy('id', 'DESC')->get();

        $userHoanThanhHoSoCapPhep = GPKhoanNuocDuoiDat::where('user_id',$user_id)->whereIn('status', [3])->with('tailieu_khoan')->orderBy('id', 'DESC')->get();

        $userDaDuocCapPhep = GPKhoanNuocDuoiDat::where('user_id',$user_id)->whereIn('status', [1])->with('tailieu_khoan')->orderBy('id', 'DESC')->get();

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
        $destroyLicense = GPKhoanNuocDuoiDat::find($id_gp);
        $destroyLicense->delete();  
        return response()->json(['success_message' => 'Xóa giấy phép thành công !' ]);
    }
}

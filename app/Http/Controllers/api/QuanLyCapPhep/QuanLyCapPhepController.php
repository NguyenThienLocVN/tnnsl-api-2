<?php

namespace App\Http\Controllers\api\QuanLyCapPhep;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;

// Models Giay Phep
// NuocMat
use App\Models\QuanlyCapPhep\NuocMat\ThuyDien\ThuyDienGiayPhep;
use App\Models\QuanlyCapPhep\NuocMat\HoChua\HoChuaGiayPhep;
use App\Models\QuanlyCapPhep\NuocMat\TramBom\TramBomGiayPhep;
use App\Models\QuanlyCapPhep\NuocMat\TramCapNuoc\TramCapNuocGiayPhep;
use App\Models\QuanlyCapPhep\NuocMat\NhaMayNuoc\NhaMayNuocGiayPhep;

// NuocDuoiDat
use App\Models\QuanlyCapPhep\NuocDuoiDat\KhaiThac\KhaiThacGiayPhep;
use App\Models\QuanlyCapPhep\NuocDuoiDat\ThamDo\ThamDoGiayPhep;
use App\Models\QuanlyCapPhep\NuocDuoiDat\HanhNgheKhoan\HanhNgheKhoanGiayPhep;


class QuanLyCapPhepController extends Controller
{
    public function countLicense()
    {
        $currentDate = Carbon::now();

        // NuocMat-----------------------------------------------------------------
        // gp_thuydien
        $allgp_thuydien = ThuyDienGiayPhep::all()->count();
        $gp_thuydienGPDaCap = ThuyDienGiayPhep::where('status', '1')->get()->count();
        $gp_thuydienChuaDuocDuyet = ThuyDienGiayPhep::where('status', '0')->get()->count();
        $gp_thuydienConHieuLuc = ThuyDienGiayPhep::where('status', '1')->where('gp_ngayhethan','>',$currentDate)->get()->count();
        $gp_thuydienSapHetHieuLuc = ThuyDienGiayPhep::where('status', '1')->whereDate('gp_ngayhethan','<',Carbon::now()->addDays(90))->whereDate('gp_ngayhethan','>',Carbon::now())->get()->count();
        $gp_thuydienHetHieuLuc = ThuyDienGiayPhep::where('status', '1')->where('gp_ngayhethan','<=',$currentDate)->get()->count();

        // gp_hochua
        $allgp_hochua = HoChuaGiayPhep::all()->count();
        $gp_hochuaGPDaCap = HoChuaGiayPhep::where('status', '1')->get()->count();
        $gp_hochuaChuaDuocDuyet = HoChuaGiayPhep::where('status', '0')->get()->count();
        $gp_hochuaConHieuLuc = HoChuaGiayPhep::where('status', '1')->where('gp_ngayhethan','>',$currentDate)->get()->count();
        $gp_hochuaSapHetHieuLuc = HoChuaGiayPhep::where('status', '1')->whereDate('gp_ngayhethan','<',Carbon::now()->addDays(90))->whereDate('gp_ngayhethan','>',Carbon::now())->get()->count();
        $gp_hochuaHetHieuLuc = HoChuaGiayPhep::where('status', '1')->where('gp_ngayhethan','<=',$currentDate)->get()->count();

        
        // gp_trambom
        $allgp_trambom = TramBomGiayPhep::all()->count();
        $gp_trambomGPDaCap = TramBomGiayPhep::where('status', '1')->get()->count();
        $gp_trambomChuaDuocDuyet = TramBomGiayPhep::where('status', '0')->get()->count();
        $gp_trambomConHieuLuc = TramBomGiayPhep::where('status', '1')->where('gp_ngayhethan','>',$currentDate)->get()->count();
        $gp_trambomSapHetHieuLuc = TramBomGiayPhep::where('status', '1')->whereDate('gp_ngayhethan','<',Carbon::now()->addDays(90))->whereDate('gp_ngayhethan','>',Carbon::now())->get()->count();
        $gp_trambomHetHieuLuc = TramBomGiayPhep::where('status', '1')->where('gp_ngayhethan','<=',$currentDate)->get()->count();

        
        // gp_tramcapnuoc
        $allgp_tramcapnuoc = TramCapNuocGiayPhep::all()->count();
        $gp_tramcapnuocGPDaCap = TramCapNuocGiayPhep::where('status', '1')->get()->count();
        $gp_tramcapnuocChuaDuocDuyet = TramCapNuocGiayPhep::where('status', '0')->get()->count();
        $gp_tramcapnuocConHieuLuc = TramCapNuocGiayPhep::where('status', '1')->where('gp_ngayhethan','>',$currentDate)->get()->count();
        $gp_tramcapnuocSapHetHieuLuc = TramCapNuocGiayPhep::where('status', '1')->whereDate('gp_ngayhethan','<',Carbon::now()->addDays(90))->whereDate('gp_ngayhethan','>',Carbon::now())->get()->count();
        $gp_tramcapnuocHetHieuLuc = TramCapNuocGiayPhep::where('status', '1')->where('gp_ngayhethan','<=',$currentDate)->get()->count();

        
        // gp_nhamaynuoc
        $allgp_nhamaynuoc = NhaMayNuocGiayPhep::all()->count();
        $gp_nhamaynuocGPDaCap = NhaMayNuocGiayPhep::where('status', '1')->get()->count();
        $gp_nhamaynuocChuaDuocDuyet = NhaMayNuocGiayPhep::where('status', '0')->get()->count();
        $gp_nhamaynuocConHieuLuc = NhaMayNuocGiayPhep::where('status', '1')->where('gp_ngayhethan','>',$currentDate)->get()->count();
        $gp_nhamaynuocSapHetHieuLuc = NhaMayNuocGiayPhep::where('status', '1')->whereDate('gp_ngayhethan','<',Carbon::now()->addDays(90))->whereDate('gp_ngayhethan','>',Carbon::now())->get()->count();
        $gp_nhamaynuocHetHieuLuc = NhaMayNuocGiayPhep::where('status', '1')->where('gp_ngayhethan','<=',$currentDate)->get()->count();

        


        // NuocDuoiDat-----------------------------------------------------------------

        // gp_ktnuocduoidat
        $allgp_ktnuocduoidat = KhaiThacGiayPhep::all()->count();
        $gp_ktnuocduoidatGPDaCap = KhaiThacGiayPhep::where('status', '1')->get()->count();
        $gp_ktnuocduoidatChuaDuocDuyet = KhaiThacGiayPhep::where('status', '0')->get()->count();
        $gp_ktnuocduoidatConHieuLuc = KhaiThacGiayPhep::where('status', '1')->where('gp_ngayhethan','>',$currentDate)->get()->count();
        $gp_ktnuocduoidatSapHetHieuLuc = KhaiThacGiayPhep::where('status', '1')->whereDate('gp_ngayhethan','<',Carbon::now()->addDays(90))->whereDate('gp_ngayhethan','>',Carbon::now())->get()->count();
        $gp_ktnuocduoidatHetHieuLuc = KhaiThacGiayPhep::where('status', '1')->where('gp_ngayhethan','<=',$currentDate)->get()->count();

        // gp_tdnuocduoidat
        $allgp_tdnuocduoidat = ThamDoGiayPhep::all()->count();
        $gp_tdnuocduoidatGPDaCap = ThamDoGiayPhep::where('status', '1')->get()->count();
        $gp_tdnuocduoidatChuaDuocDuyet = ThamDoGiayPhep::where('status', '0')->get()->count();
        $gp_tdnuocduoidatConHieuLuc = ThamDoGiayPhep::where('status', '1')->where('gp_ngayhethan','>',$currentDate)->get()->count();
        $gp_tdnuocduoidatSapHetHieuLuc = ThamDoGiayPhep::where('status', '1')->whereDate('gp_ngayhethan','<',Carbon::now()->addDays(90))->whereDate('gp_ngayhethan','>',Carbon::now())->get()->count();
        $gp_tdnuocduoidatHetHieuLuc = ThamDoGiayPhep::where('status', '1')->where('gp_ngayhethan','<=',$currentDate)->get()->count();
        
        // gp_khoannuocduoidat
        $allgp_khoannuocduoidat = HanhNgheKhoanGiayPhep::all()->count();
        $gp_khoannuocduoidatGPDaCap = HanhNgheKhoanGiayPhep::where('status', '1')->get()->count();
        $gp_khoannuocduoidatChuaDuocDuyet = HanhNgheKhoanGiayPhep::where('status', '0')->get()->count();
        $gp_khoannuocduoidatConHieuLuc = HanhNgheKhoanGiayPhep::where('status', '1')->where('gp_ngayhethan','>',$currentDate)->get()->count();
        $gp_khoannuocduoidatSapHetHieuLuc = HanhNgheKhoanGiayPhep::where('status', '1')->whereDate('gp_ngayhethan','<',Carbon::now()->addDays(90))->whereDate('gp_ngayhethan','>',Carbon::now())->get()->count();
        $gp_khoannuocduoidatHetHieuLuc = HanhNgheKhoanGiayPhep::where('status', '1')->where('gp_ngayhethan','<=',$currentDate)->get()->count();

        return [

            'gp_nuocmat' => [
                'tat_ca_giay_phep' => $allgp_thuydien + $allgp_hochua + $allgp_trambom + $allgp_tramcapnuoc + $allgp_nhamaynuoc,
                'giay_phep_da_cap' => $gp_thuydienGPDaCap + $gp_hochuaGPDaCap + $gp_trambomGPDaCap + $gp_tramcapnuocGPDaCap + $gp_nhamaynuocGPDaCap,
                'chua_phe_duyet' => $gp_thuydienChuaDuocDuyet + $gp_hochuaChuaDuocDuyet + $gp_trambomChuaDuocDuyet + $gp_tramcapnuocChuaDuocDuyet + $gp_nhamaynuocChuaDuocDuyet,
                'con_hieu_luc' => $gp_thuydienConHieuLuc + $gp_hochuaConHieuLuc + $gp_trambomConHieuLuc + $gp_tramcapnuocConHieuLuc + $gp_nhamaynuocConHieuLuc,
                'sap_het_hieu_luc' => $gp_thuydienSapHetHieuLuc + $gp_hochuaSapHetHieuLuc + $gp_trambomSapHetHieuLuc + $gp_tramcapnuocSapHetHieuLuc + $gp_nhamaynuocSapHetHieuLuc,
                'het_hieu_luc' => $gp_thuydienHetHieuLuc + $gp_hochuaHetHieuLuc + $gp_trambomHetHieuLuc + $gp_tramcapnuocHetHieuLuc + $gp_nhamaynuocHetHieuLuc,
            ],
            'gp_nuocduoidat' => [
                'tat_ca_giay_phep' => $allgp_ktnuocduoidat + $allgp_tdnuocduoidat + $allgp_khoannuocduoidat,
                'giay_phep_da_cap' => $gp_ktnuocduoidatGPDaCap + $gp_tdnuocduoidatGPDaCap + $gp_khoannuocduoidatGPDaCap,
                'chua_phe_duyet' => $gp_ktnuocduoidatChuaDuocDuyet + $gp_tdnuocduoidatChuaDuocDuyet + $gp_khoannuocduoidatChuaDuocDuyet,
                'con_hieu_luc' => $gp_ktnuocduoidatConHieuLuc + $gp_tdnuocduoidatConHieuLuc + $gp_khoannuocduoidatConHieuLuc,
                'sap_het_hieu_luc' => $gp_ktnuocduoidatSapHetHieuLuc + $gp_tdnuocduoidatSapHetHieuLuc + $gp_khoannuocduoidatSapHetHieuLuc,
                'het_hieu_luc' => $gp_ktnuocduoidatHetHieuLuc + $gp_tdnuocduoidatHetHieuLuc + $gp_khoannuocduoidatHetHieuLuc,
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

        $label = [];

        $dataCharts = [
            'gp_nuocmat' => [],
            'gp_nuocduoidat' => [],
            'gp_xathai' => [5, 7, 7, 4, 2],
        ];

        $dataDoughnut = [
            'gp_nuocmat' => [],
            'gp_nuocduoidat' => [],
            'gp_xathai' => [5, 7, 7, 4, 2],
        ];

        for($i = $startYear ; $i<= $endYear ; $i++){
            array_push($label, (int)$i);
            // dataCharts-------------------------------------------------------------
            // NuocMat-------------------------------------------------------------------
            $count_thuydien = ThuyDienGiayPhep::where('status', '1')->whereYear('gp_ngaycap', $i)->get()->count();
            $count_hochua = HoChuaGiayPhep::where('status', '1')->whereYear('gp_ngaycap', $i)->get()->count();
            $count_trambom = TramBomGiayPhep::where('status', '1')->whereYear('gp_ngaycap', $i)->get()->count();
            $count_tramcapnuoc = TramCapNuocGiayPhep::where('status', '1')->whereYear('gp_ngaycap', $i)->get()->count();
            $count_nhamaynuoc = NhaMayNuocGiayPhep::where('status', '1')->whereYear('gp_ngaycap', $i)->get()->count();
            $gp_nuocmat =  $count_thuydien + $count_hochua + $count_trambom + $count_tramcapnuoc + $count_nhamaynuoc;

            array_push($dataCharts['gp_nuocmat'], $gp_nuocmat);
             // NuocDuoiDat-------------------------------------------------------------------
            $count_khaithac = KhaiThacGiayPhep::where('status', '1')->whereYear('gp_ngaycap', $i)->get()->count();
            $count_thamdo = ThamDoGiayPhep::where('status', '1')->whereYear('gp_ngaycap', $i)->get()->count();
            $count_khanhnghekhoan = TramBomGiayPhep::where('status', '1')->whereYear('gp_ngaycap', $i)->get()->count();
            $gp_nuocduoidat =  $count_khaithac + $count_thamdo + $count_khanhnghekhoan;
            array_push($dataCharts['gp_nuocduoidat'], $gp_nuocduoidat);

        }

        if( intval($startYear) < 2000 || intval($endYear) > $currentDate->format('Y')){
            $msg = "Dữ liệu chỉ hiển thị từ năm 2000 đến ".$currentDate->format('Y');
            return [
                'label' => [],
                'dataCharts' => [],
                'error_message' => $msg,
            ];
        }else{
            return [
            'label' => $label,
            'dataCharts' => $dataCharts,
            ];
        }
    }
}
